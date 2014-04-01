<?php

namespace Pn\PnBundle\Controller;

use Pn\PnBundle\Entity\Babysitter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Pn\PnBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Pn\PnBundle\Form\UserType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $babysitters = $em->getRepository('PnPnBundle:User')->getLastBabysitters();

        return $this->render('PnPnBundle:Default:index.html.twig', array(
            'babysitters' => $babysitters
        ));
    }

    public function loginAction()
    {
        $request = $this->get('request');
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('PnPnBundle:Default:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
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
            return $this->render('PnPnBundle:Default:notconnected.html.twig');
        }
        else
        {
            return $this->render('PnPnBundle:Default:connected.html.twig');
        }
    }

    public function registerAction(Request $request)
    {
        $entity = new User();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // encode password
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($entity);
            $encodedPassword = $encoder->encodePassword($form["rawPassword"]->getData(), $entity->getSalt());
            $entity->setPassword($encodedPassword);

            if ($form["type"]->getData() == 'nounou')
            {
                $babysitter = new Babysitter();
                $babysitter->setUser($entity);
                $em->persist($babysitter);
            }

            // enregistrement en BDD
            $em->persist($entity);
            $em->flush();

            // Connexion
            $token = new UsernamePasswordToken($entity, null, 'main', $entity->getRoles());
            $this->get('security.context')->setToken($token);

            return $this->redirect($this->generateUrl('myprofile'));
        }

        return $this->render('PnPnBundle:Default:register.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
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
            return $this->redirect($this->generateUrl('babysitter_show', array('id' => $nounou->getId())));
        }
        elseif ($type == 'parent')
        {
            return $this->redirect($this->generateUrl('pn_job_new'));
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
            return $this->redirect($this->generateUrl('pn_job_new'));
        }
        else
        {
            throw $this->createNotFoundException('Wrong user type.');
        }
    }
}
