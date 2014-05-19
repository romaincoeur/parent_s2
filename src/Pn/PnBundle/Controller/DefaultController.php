<?php

namespace Pn\PnBundle\Controller;

use Pn\PnBundle\Form\ContactType;
use Pn\PnBundle\Form\Model\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Pn\PnBundle\Entity\User;
use Pn\PnBundle\Form\UserType;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $babysitters = $em->getRepository('PnPnBundle:User')->getLastUpdatedBabysitters(3);

        $articles = $em->getRepository('PnBlogBundle:Article')->getOnWelcomePageList();

        $nounous = $em->getRepository('PnPnBundle:Babysitter')->findAll();

        $jobs = $em->getRepository('PnPnBundle:Job')->findAll();

        return $this->render('PnPnBundle:Default:index.html.twig', array(
            'babysitters' => $babysitters,
            'nounous' => $nounous,
            'articles' => $articles,
            'jobs' => $jobs
        ));
    }

    /**
     * Affiche le header selon si l'utilisateur est connecté ou pas
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function headerAction()
    {
        $user = $this->getUser();
        if ($user === null)
        {
            $entity = new User();

            return $this->render('PnPnBundle:Default:notconnected.html.twig', array(
                'entity' => $entity,
            ));
        }
        else
        {
            return $this->render('PnPnBundle:Default:connected.html.twig');
        }
    }

    /**
     * Creates a form to create a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('register'),
            'method' => 'POST',
        ));

        return $form;
    }

    public function contactAction(Request $request)
    {
        $contactModel = new Contact();
        $form = $this->createForm(new ContactType(), $contactModel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // Envoyer un email de contact
            $Url = $this->generateUrl('message', array(), true);
            $mail = $em->getRepository('PnPnBundle:MailTemplate')->findOneByVirtualTitle('contactMail');
            $body = str_replace(
                array('%FIRSTNAME', '%LASTNAME', '%EMAIL', '%MESSAGE'),
                array($form["firstname"]->getData(), $form["lastname"]->getData(), $form["email"]->getData(), $form["message"]->getData()),
                $mail->getBody()
            );

            $message = \Swift_Message::newInstance()
                ->setSubject($mail->getObject())
                ->setFrom($this->container->getparameter('mailer.from'))
                ->setTo($this->container->getparameter('mailer.from'))
                ->setBody($body)
            ;
            $message->getHeaders()->get('Content-Type')->setValue('text/html');

            $this->get('mailer')->send($message);

            // Response
            $response['success'] = true;
            return new JsonResponse( $response );
        }

        if ($request->isXmlHttpRequest())
        {
            $response['success'] = false;
            $response['cause'] = 'Formulaire invalide';
            return new JsonResponse( $response );
        }
        else
        {
            return $this->render('PnPnBundle:Default:contact.html.twig', array(
                'contact_form' => $form->createView(),
            ));
        }
    }

    public function myprofileViewAction()
    {
        $user = $this->getUser();
        if ($user == null)
        {
            return $this->redirect($this->generateUrl('pn_pn_homepage'));
        }
        $type = $user->getType();

        if ($type == 'nounou')
        {
            $nounou = $user->getBabysitter();
            return $this->redirect($this->generateUrl('babysitter_show', array('id' => $nounou->getId(), 'url' => $nounou->getUrl())));
        }
        elseif ($type == 'parent')
        {
            $parent = $this->getUser()->getParent();
            $em = $this->getDoctrine()->getManager();
            $currentAnnonce = $em->getRepository('PnPnBundle:Job')->getAnnonce($parent);

            if ($currentAnnonce == null)
            {
                return $this->redirect($this->generateUrl('pn_job_new'));
            }
            else
            {
                return $this->redirect($this->generateUrl('pn_job_show', array('id' => $currentAnnonce[0]->getId(), 'url' => $currentAnnonce[0]->getUrl())));
            }
        }
        else
        {
            throw $this->createNotFoundException('Wrong user type.');
        }
    }

    public function myprofileEditAction()
    {
        $user = $this->getUser();
        if ($user == null)
        {
            return $this->redirect($this->generateUrl('pn_pn_homepage'));
        }
        $type = $user->getType();

        if ($type == 'nounou')
        {
            $nounou = $user->getBabysitter();
            return $this->redirect($this->generateUrl('babysitter_edit', array('id' => $nounou->getId())));
        }
        elseif ($type == 'parent')
        {
            $parent = $this->getUser()->getParent();
            $em = $this->getDoctrine()->getManager();
            $currentAnnonce = $em->getRepository('PnPnBundle:Job')->getAnnonce($parent);

            if ($currentAnnonce == null)
            {
                return $this->redirect($this->generateUrl('pn_job_new'));
            }
            else
            {
                return $this->redirect($this->generateUrl('pn_job_edit'));
            }
        }
        else
        {
            throw $this->createNotFoundException('Wrong user type.');
        }
    }

    /**
     * Handle the search form of the welcome page
     */
    public function searchAction()
    {
        $request = $this->get('request');

        $select = $request->get('searchType');
        $field = $request->get('field');
        $place = json_decode($request->get('place'));

        if ($select == 'nounou')
        {
            return $this->redirect($this->generateUrl('babysitter_search', array(
                'search'    => $field,
                'top'       => $request->get('placeTop'),
                'bottom'    => $request->get('placeBottom'),
                'left'      => $request->get('placeLeft'),
                'right'     => $request->get('placeRight'),
            )));
        }
        elseif ($select == 'job')
        {
            return $this->redirect($this->generateUrl('pn_job_search', array(
                'search'    => $field,
                'top'       => $request->get('placeTop'),
                'bottom'    => $request->get('placeBottom'),
                'left'      => $request->get('placeLeft'),
                'right'     => $request->get('placeRight'),
            )));
        }
        else
        {
            //Todo throw error
        }
    }

    public function teamAction()
    {

        return $this->render('PnPnBundle:Default:team.html.twig');
    }

    public function cguAction()
    {

        return $this->render('PnPnBundle:Default:cgu.html.twig');
    }

}
