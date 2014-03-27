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

        return $this->render('PnPnBundle:Babysitter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
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

        return $this->render('PnPnBundle:Babysitter:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Babysitter entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Babysitter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Babysitter entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PnPnBundle:Babysitter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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

        $form->add('submit', 'submit', array('label' => 'Update'));

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

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('babysitter_edit', array('id' => $id)));
        }

        return $this->render('PnPnBundle:Babysitter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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
