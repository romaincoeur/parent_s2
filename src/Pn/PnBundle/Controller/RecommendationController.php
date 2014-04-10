<?php

namespace Pn\PnBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pn\PnBundle\Entity\Recommendation;
use Pn\PnBundle\Form\RecommendationType;

/**
 * Recommendation controller.
 *
 */
class RecommendationController extends Controller
{

    /**
     * Lists all Recommendation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PnPnBundle:Recommendation')->findAll();

        return $this->render('PnPnBundle:Recommendation:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Recommendation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Recommendation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('recommendation_show', array('id' => $entity->getId())));
        }

        return $this->render('PnPnBundle:Recommendation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Recommendation entity.
    *
    * @param Recommendation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Recommendation $entity)
    {
        $form = $this->createForm(new RecommendationType(), $entity, array(
            'action' => $this->generateUrl('recommendation_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Recommendation entity.
     *
     */
    public function newAction()
    {
        $entity = new Recommendation();
        $form   = $this->createCreateForm($entity);

        return $this->render('PnPnBundle:Recommendation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Recommendation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Recommendation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recommendation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PnPnBundle:Recommendation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Recommendation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Recommendation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recommendation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PnPnBundle:Recommendation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Recommendation entity.
    *
    * @param Recommendation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Recommendation $entity)
    {
        $form = $this->createForm(new RecommendationType(), $entity, array(
            'action' => $this->generateUrl('recommendation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Recommendation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Recommendation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recommendation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('recommendation_edit', array('id' => $id)));
        }

        return $this->render('PnPnBundle:Recommendation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Recommendation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PnPnBundle:Recommendation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Recommendation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('recommendation'));
    }

    /**
     * Creates a form to delete a Recommendation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('recommendation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
