<?php

namespace Pn\PnBundle\Controller;

use Pn\PnBundle\Entity\Pparent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Pn\PnBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\JsonResponse;
use Pn\PnBundle\Form\ChangePasswordType;
use Pn\PnBundle\Form\Model\ChangePassword;


class SecurityController extends Controller
{

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

    public function registerAction(Request $request)
    {
        $entity = new User();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            try
            {
                $em = $this->getDoctrine()->getManager();

                // encode password
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($entity);
                $encodedPassword = $encoder->encodePassword($form["rawPassword"]->getData(), $entity->getSalt());
                $entity->setPassword($encodedPassword);

                if ($form["type"]->getData() == 'nounou')
                {
                    $em->persist($entity->getBabysitter());
                }
                elseif ($form["type"]->getData() == 'parent')
                {
                    $parent = new Pparent();
                    $parent->setUser($entity);
                    $em->persist($parent);
                }

                // enregistrement en BDD
                $em->persist($entity);
                $em->flush();

                // Correction du bug de clef étrangere
                // Maniere peu délicate
                $babysitter = $entity->getBabysitter();
                $babysitter->setUser($entity);
                $em->persist($babysitter);
                $em->flush();

                // Envoyer un email de confirmation
                $confirmationUrl = $this->generateUrl('confirmation', array('token' => $entity->getConfirmationToken()), true);
                $mail = $em->getRepository('PnPnBundle:MailTemplate')->findOneByVirtualTitle('maildeconfirmation');

                $message = \Swift_Message::newInstance()
                    ->setSubject($mail->getObject())
                    ->setFrom($this->container->getparameter('mailer.from'))
                    ->setTo($entity->getEmail())
                    ->setBody(str_replace('%URL', $confirmationUrl, $mail->getBody()))
                ;
                $message->getHeaders()->get('Content-Type')->setValue('text/html');

                $this->get('mailer')->send($message);

                // Connexion
                $token = new UsernamePasswordToken($entity, null, 'main', $entity->getRoles());
                $this->get('security.context')->setToken($token);

                // Response
                $response['success'] = true;
                return new JsonResponse( $response );
            }
            catch (\Exception $e)
            {
                $response['success'] = false;
                $response['cause'] = $e;
                return new JsonResponse( $response );
            }
        }

        if ($request->isXmlHttpRequest())
        {
            $response['success'] = false;
            $response['cause'] = 'Formulaire invalide';
            return new JsonResponse( $response );
        }
        else
        {
            return $this->render('PnPnBundle:Default:register.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));
        }
    }

    public function confirmationAction($token)
    {
        $repository = $this->getDoctrine()->getRepository('PnPnBundle:User');
        $entity = $repository->findOneByConfirmationToken($token);

        if ($entity == null)
        {
            throw $this->createNotFoundException('The token does not correspond to any user.');
        }
        else
        {
            $entity->setConfirmationToken('');
            $entity->setConfirmed(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            // Envoyer un email de bienvenue
            $mail = $em->getRepository('PnPnBundle:MailTemplate')->findOneByTitle('mail de bienvenue');
            $message = \Swift_Message::newInstance()
                ->setSubject($mail->getObject())
                ->setFrom($this->container->getparameter('mailer.from'))
                ->setTo($entity->getEmail())
                ->setBody($mail->getBody())
            ;
            $message->getHeaders()->get('Content-Type')->setValue('text/html');
            $this->get('mailer')->send($message);

            // Connexion
            $token = new UsernamePasswordToken($entity, null, 'main', $entity->getRoles());
            $this->get('security.context')->setToken($token);

            return $this->redirect($this->generateUrl('pn_pn_homepage'));
        }
        return $this->redirect($this->generateUrl('pn_pn_homepage'));
    }

    public function changePasswordAction(Request $request)
    {
        $changePasswordModel = new ChangePassword();
        $form = $this->createForm(new ChangePasswordType(), $changePasswordModel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();

            // encode old password
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $encodedOldPassword = $encoder->encodePassword($form["oldPassword"]->getData(), $user->getSalt());

            if ($encodedOldPassword == $user->getPassword())
            {
                // encode new password
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $encodedNewPassword = $encoder->encodePassword($form["newPassword"]->getData(), $user->getSalt());
                $user->setPassword($encodedNewPassword);

                // persist in DB
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // Response
                $response['success'] = true;
                return new JsonResponse( $response );
            }
            else
            {
                $response['success'] = false;
                $response['cause'] = 'L\'ancien mot de passe n\'est pas valide';
                return new JsonResponse( $response );
            }
        }

        if ($request->isXmlHttpRequest())
        {
            $response['success'] = false;
            $response['cause'] = 'Formulaire invalide';
            return new JsonResponse( $response );
        }
        else
        {
            return $this->render('PnPnBundle:Default:changePassword.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }

    public function resetPasswordAction()
    {
        try
        {
            $em = $this->getDoctrine()->getManager();
            $rawPassword = $this->random(20);
            $email = $this->get('request')->get('_username');
            $user = $em->getRepository('PnPnBundle:User')->findOneByEmail($email);

            // check user
            if ($user == null)
            {
                $response['success'] = false;
                $response['has_error'] = true;
                $response['message'] = 'L\'email fourni ne correspond à aucun utilisateur';
                $response['error'] = 'L\'email fourni ne correspond à aucun utilisateur';
                return new JsonResponse( $response );
            }

            // encode and set new password
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $encodedPassword = $encoder->encodePassword($rawPassword, $user->getSalt());
            $user->setPassword($encodedPassword);
            $user->setRawPassword($rawPassword);
            $em->persist($user);
            $em->flush();

            // Send email
            $mail = $em->getRepository('PnPnBundle:MailTemplate')->findOneByVirtualTitle('resetPasswordMail');

            $message = \Swift_Message::newInstance()
                ->setSubject($mail->getObject())
                ->setFrom($this->container->getparameter('mailer.from'))
                ->setTo($user->getEmail())
                ->setBody(str_replace('%PASSWORD', $rawPassword, $mail->getBody()))
            ;
            $message->getHeaders()->get('Content-Type')->setValue('text/html');

            $this->get('mailer')->send($message);

            // Response
            $response['success'] = true;
            return new JsonResponse( $response );
        }
        catch (\Exception $e)
        {
            $response['success'] = false;
            $response['message'] = toString($e);
            $response['error'] = toString($e);
            return new JsonResponse( $response );
        }
    }

    private function random($car) {
        $string = "";
        $chaine = "abcdefghijklmnpqrstuvwxy0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ(-_)=+*!:;,?.%~#{[|@]}";
        srand((double)microtime()*1000000);
        for($i=0; $i<$car; $i++) {
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }


}
