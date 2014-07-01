<?php

namespace Pn\PnBundle\Controller;

use Application\Sonata\UserBundle\Entity\User;
use Application\Sonata\UserBundle\Form\RegistrationFormType;
use FOS\UserBundle\Model\UserInterface;
use Pn\PnBundle\Entity\Babysitter;
use Pn\PnBundle\Entity\Pparent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\SecurityContext;
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
            $body = str_replace(
                array('%FIRSTNAME'),
                array($entity->getFirstname()),
                $mail->getBody()
            );
            $message = \Swift_Message::newInstance()
                ->setSubject($mail->getObject())
                ->setFrom($this->container->getparameter('mailer.from'))
                ->setTo($entity->getEmail())
                ->setBody($body)
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
            $body = str_replace(
                array('%FIRSTNAME', '%EMAIL', '%PASSWORD'),
                array($user->getFirstname(), $user->getEmail(), $rawPassword),
                $mail->getBody()
            );
            $message = \Swift_Message::newInstance()
                ->setSubject($mail->getObject())
                ->setFrom($this->container->getparameter('mailer.from'))
                ->setTo($user->getEmail())
                ->setBody($body)
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

    public function getErrorsAsArray($form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $key => $child) {
            if ($err = $this->getErrorsAsArray($child)) {
                $errors[$key] = $err;
            }
        }

        return $errors;
    }

    public function getErrorsAsString($form)
    {
        $errors = "";
        foreach ($form->getErrors() as $error) {
            $errors .= $error->getMessage()."\n";
        }

        foreach ($form->all() as $key => $child) {
            if ($err = $this->getErrorsAsString($child)) {
                $errors .= $err;
            }
        }

        return $errors;
    }

    /**
     * Authenticate a user with Symfony Security
     *
     * @param \FOS\UserBundle\Model\UserInterface        $user
     * @param \Symfony\Component\HttpFoundation\Response $response
     */
    protected function authenticateUser(UserInterface $user, Response $response)
    {
        try {
            $this->container->get('fos_user.security.login_manager')->loginUser(
                $this->container->getParameter('fos_user.firewall_name'),
                $user,
                $response);
        } catch (AccountStatusException $ex) {
            // We simply do not authenticate users which do not pass the user
            // checker (not enabled, expired, etc.).
        }
    }

    /**
     * @param string $action
     * @param string $value
     */
    protected function setFlash($action, $value)
    {
        $this->container->get('session')->getFlashBag()->set($action, $value);
    }

    protected function getEngine()
    {
        return $this->container->getParameter('fos_user.template.engine');
    }
}
