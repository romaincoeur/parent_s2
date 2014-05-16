<?php

namespace Pn\PnBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pn\PnBundle\Entity\Message;
use Pn\PnBundle\Form\MessageType;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Message controller.
 *
 */
class MessageController extends Controller
{

    /**
     * Lists all Message entities.
     *
     */
    public function indexAction($conv = null)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $exceptIds = array($user->getId());
        $new_conv = false;

        $entities = $em->getRepository('PnPnBundle:Message')->getConversations($user);


        // Sort messages by conversation
        $result = array();

        foreach ($entities as $raw)
        {
            $interlocuteur = $raw->getSender()==$user ? $raw->getReceiver() : $raw->getSender();
            if (!array_key_exists ( $interlocuteur->getVirtualname() , $result ))
            {
                $form = $this->createForm(new MessageType(), new Message(), array(
                    'action' => $this->generateUrl('message_send',array('to' => $interlocuteur->getId())),
                    'method' => 'POST',
                ));
                $result[$interlocuteur->getVirtualname()]['messages'] = array();
                $result[$interlocuteur->getVirtualname()]['unread'] = 0;
                $result[$interlocuteur->getVirtualname()]['object'] = $interlocuteur;
                $result[$interlocuteur->getVirtualname()]['form'] = $form->createView();

                array_push ( $exceptIds, $interlocuteur->getId() );
            }
            array_push ( $result[$interlocuteur->getVirtualname()]['messages'] , $raw );
        }

        // Check new conv
        if (!in_array( $conv, $exceptIds) && $conv != null)
        {
            $interlocuteur = $em->getRepository('PnPnBundle:User')->findOneById($conv);
            $form = $this->createForm(new MessageType(), new Message(), array(
                'action' => $this->generateUrl('message_send',array('to' => $interlocuteur->getId())),
                'method' => 'POST',
            ));
            $result[$interlocuteur->getVirtualname()]['messages'] = array();
            $result[$interlocuteur->getVirtualname()]['unread'] = 0;
            $result[$interlocuteur->getVirtualname()]['object'] = $interlocuteur;
            $result[$interlocuteur->getVirtualname()]['form'] = $form->createView();

            array_push ( $exceptIds, $interlocuteur->getId() );
        }

        // Get users for new conversation
        $users = $em->getRepository('PnPnBundle:User')->findAllExcept($exceptIds);

        return $this->render('PnPnBundle:Message:index.html.twig', array(
            'conversations' => $result,
            'users' => $users,
            'conv' => $conv,
            'new_conv' => $new_conv
        ));
    }

    /**
     * Creates a new Message entity.
     *
     */
    public function sendAction(Request $request, $to)
    {
        $em = $this->getDoctrine()->getManager();
        $sender = $this->getUser();
        $receiver = $em->getRepository('PnPnBundle:User')->findOneById($to);
        $entity = new Message();
        $form = $this->createForm(new MessageType(), $entity, array(
            'action' => $this->generateUrl('message_send', array('to' => $to)),
            'method' => 'POST',
        ));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setSender($sender);
            $entity->setReceiver($receiver);
            $em->persist($entity);
            $em->flush();

            // Envoyer un email de confirmation
            $Url = $this->generateUrl('message', array(), true);
            $mail = $em->getRepository('PnPnBundle:MailTemplate')->findOneByVirtualTitle('nouveaumessage');
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
     * Creates a new Message entity.
     *
     */
    public function newConversationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sender = $this->getUser();
        $receiverID = $request->request->get('userId');
        $receiver = $em->getRepository('PnPnBundle:User')->findOneById($receiverID);
        $entity = new Message();
        $form = $this->createForm(new MessageType(), $entity, array(
            'action' => $this->generateUrl('message_send', array('to' => $receiverID)),
            'method' => 'POST',
        ));
        $form->handleRequest($request);

        try {
            $entity->setSender($sender);
            $entity->setReceiver($receiver);
            $em->persist($entity);
            $em->flush();

            // Envoyer un email de confirmation
            $Url = $this->generateUrl('message', array(), true);
            $mail = $em->getRepository('PnPnBundle:MailTemplate')->findOneByVirtualTitle('nouveaumessage');
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
        catch (\Exception $e)
        {
            $response['success'] = false;
            $response['error'] = toString($e);
            return new JsonResponse( $response );
        }
    }

    /**
     * Creates a new Message entity.
     *
     */
    public function deleteConversationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sender = $this->getUser();
        $receiver = $em->getRepository('PnPnBundle:User')->findOneById($to);
        $entity = new Message();
        $form = $this->createForm(new MessageType(), $entity, array(
            'action' => $this->generateUrl('message_send', array('to' => $to)),
            'method' => 'POST',
        ));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setSender($sender);
            $entity->setReceiver($receiver);
            $em->persist($entity);
            $em->flush();

            // Envoyer un email de confirmation
            $Url = $this->generateUrl('message', array(), true);
            $mail = $em->getRepository('PnPnBundle:MailTemplate')->findOneByVirtualTitle('nouveaumessage');
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
     * Creates a form to create a Message entity.
     *
     * @param Message $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Message $entity)
    {
        $form = $this->createForm(new MessageType(), $entity, array(
            'action' => $this->generateUrl('message_send'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Message entity.
     *
     */
    public function newAction()
    {
        $entity = new Message();
        $form   = $this->createCreateForm($entity);

        return $this->render('PnPnBundle:Message:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Message entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Message')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PnPnBundle:Message:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Message entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Message')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PnPnBundle:Message:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Message entity.
     *
     * @param Message $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Message $entity)
    {
        $form = $this->createForm(new MessageType(), $entity, array(
            'action' => $this->generateUrl('message_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Message entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Message')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('message_edit', array('id' => $id)));
        }

        return $this->render('PnPnBundle:Message:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Message entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PnPnBundle:Message')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Message entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('message'));
    }

    /**
     * Creates a form to delete a Message entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('message_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }
}
