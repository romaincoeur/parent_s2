<?php

namespace Pn\PnBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pn\PnBundle\Entity\Recommendation;
use Pn\PnBundle\Form\RecommendationType;
use Symfony\Component\HttpFoundation\JsonResponse;


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
    public function sendAction(Request $request, $to)
    {
        $em = $this->getDoctrine()->getManager();
        $sender = $this->getUser();
        if (!$sender)
        {
            throw $this->createNotFoundException('Vous devez être connecté pour accéder à cette fonctionalité');
        }
        $receiver = $em->getRepository('ApplicationSonataUserBundle:User')->findOneById($to);
        if ($receiver->getId() == $sender->getId())
        {
            throw $this->createNotFoundException('Vous ne pouvez vous recommander vous même');
        }
        $entity = new Recommendation();
        $form = $this->createForm(new RecommendationType(), $entity, array(
            'action' => $this->generateUrl('recommendation_send', array('to' => $to)),
            'method' => 'POST',
        ));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setGiver($sender);
            $entity->setReceiver($receiver);
            $em->persist($entity);
            $em->flush();

            // Envoyer un email
            if ($receiver->getType() == 'nounou')
            {
                $Url = $this->generateUrl('babysitter_show', array('id' => $receiver->getBabysitter()->getId(), 'url' => $receiver->getBabysitter()->getUrl()), true).'#recommandations';
            }
            else
            {
                $Url = $this->generateUrl('pn_job_show', array('id' => $receiver->getParent()->getCurrentJob()->getId(), 'url' => $receiver->getParent()->getCurrentJob()->getUrl()), true).'#recommandations';
            }
            $mail = $em->getRepository('PnPnBundle:MailTemplate')->findOneByVirtualTitle('newRecommandation');
            if (!$mail) {
                throw $this->createNotFoundException('le template d\'email "Nouvelle recommendation n\'est pas defini."');
            }
            $body = str_replace(
                array('%SENDER', '%MESSAGE', '%URL'),
                array($sender->getFirstname(), $entity->getBody(), $Url),
                $mail->getBody()
            );

            $message = \Swift_Message::newInstance()
                ->setSubject($mail->getObject())
                ->setFrom($this->container->getparameter('mailer.from'))
                ->setTo($receiver->getEmail())
                ->setBody($body)
            ;
            $message->getHeaders()->get('Content-Type')->setValue('text/html');

            $this->get('mailer')->send($message);

            $response['success'] = true;
            $response['message'] = $entity->getBody();
            return new JsonResponse( $response );
        }

        $response['success'] = false;
        return new JsonResponse( $response );
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
