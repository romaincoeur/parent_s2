<?php

namespace Pn\PnBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pn\PnBundle\Entity\Pparent;
use Pn\PnBundle\Form\PparentType;

/**
 * Pparent controller.
 *
 */
class PparentController extends Controller
{

    /**
     * Lists all Pparent entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PnPnBundle:Pparent')->findAll();

        return $this->render('PnPnBundle:Pparent:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Pparent entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Pparent();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('parent_show', array('id' => $entity->getId())));
        }

        return $this->render('PnPnBundle:Pparent:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Pparent entity.
    *
    * @param Pparent $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Pparent $entity)
    {
        $form = $this->createForm(new PparentType(), $entity, array(
            'action' => $this->generateUrl('parent_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Pparent entity.
     *
     */
    public function newAction()
    {
        $entity = new Pparent();
        $form   = $this->createCreateForm($entity);

        return $this->render('PnPnBundle:Pparent:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pparent entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Pparent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pparent entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PnPnBundle:Pparent:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Pparent entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Pparent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pparent entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PnPnBundle:Pparent:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Pparent entity.
    *
    * @param Pparent $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pparent $entity)
    {
        $form = $this->createForm(new PparentType(), $entity, array(
            'action' => $this->generateUrl('parent_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Pparent entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Pparent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pparent entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('parent_edit', array('id' => $id)));
        }

        return $this->render('PnPnBundle:Pparent:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pparent entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PnPnBundle:Pparent')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pparent entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('parent'));
    }

    /**
     * Creates a form to delete a Pparent entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('parent_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
