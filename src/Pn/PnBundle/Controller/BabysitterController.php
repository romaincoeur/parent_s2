<?php

namespace Pn\PnBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pn\PnBundle\Entity\Babysitter;
use Pn\PnBundle\Form\BabysitterType;

/**
 * Babysitter controller.
 *
 */
class BabysitterController extends Controller
{

    /**
     * Lists all Babysitter entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PnPnBundle:Babysitter')->findAll();

        return $this->render('PnPnBundle:Babysitter:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Lists Babysitter entities.
     *
     */
    public function searchAction($search)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PnPnBundle:Babysitter')->getFromSearch($search);

        return $this->render('PnPnBundle:Babysitter:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Babysitter entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Babysitter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('babysitter_show', array('id' => $entity->getId())));
        }

        return $this->render('PnPnBundle:Babysitter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Babysitter entity.
    *
    * @param Babysitter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Babysitter $entity)
    {
        $form = $this->createForm(new BabysitterType(), $entity, array(
            'action' => $this->generateUrl('babysitter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Babysitter entity.
     *
     */
    public function newAction()
    {
        $entity = new Babysitter();
        $form   = $this->createCreateForm($entity);

        // gestion du calendrier
        $calendarService = $this->container->get('pn.calendar');
        $calendar = $calendarService->newMatrix();

        return $this->render('PnPnBundle:Babysitter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'calendarMatrix' => $calendar
        ));
    }

    /**
     * Finds and displays a Babysitter entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Babysitter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Babysitter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $calendarStr = str_split($entity->getCalendar(),1);

        $calendar = array_fill(1, 24 ,array_fill(1, 7, false));

        $i = 1;
        $j = 1;
        foreach ($calendarStr as &$c)
        {
            if ($c == ')')
            {
                $j = 1;
                $i++;
                continue;
            }
            if ($c == '0')
            {
                $j++;
            }
            if ($c == '1')
            {
                $calendar[$i][$j] = true;
                $j++;
            }
        }

        return $this->render('PnPnBundle:Babysitter:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'calendarMatrix' => $calendar,
            'id' => $id
        ));
    }

    /**
     * Displays a form to edit an existing Babysitter entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Babysitter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Babysitter entity.');
        }

        $form = $this->createForm(new BabysitterType(), $entity);

        $form->handleRequest($request);

        if ($form->isValid()){
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('babysitter_show', array('id' => $id)));
        }

        // gestion du calendrier
        $calendarService = $this->container->get('pn.calendar');
        $calendar = $calendarService->getMatrix($entity->getCalendar());

        return $this->render('PnPnBundle:Babysitter:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $form->createView(),
            'calendarMatrix' => $calendar,
            'id' => $id
        ));
    }

    /**
    * Creates a form to edit a Babysitter entity.
    *
    * @param Babysitter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Babysitter $entity)
    {
        $form = $this->createForm(new BabysitterType(), $entity, array(
            'action' => $this->generateUrl('babysitter_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Babysitter entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Babysitter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Babysitter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        $calendar = $this->createCalendar($entity->getCalendar());

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('babysitter_show', array('id' => $id)));
        }

        return $this->render('PnPnBundle:Babysitter:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'id'          => $id,
            'calendarMatrix'    => $calendar
        ));
    }
    /**
     * Deletes a Babysitter entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PnPnBundle:Babysitter')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Babysitter entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('babysitter'));
    }

    /**
     * Creates a form to delete a Babysitter entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('babysitter_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
