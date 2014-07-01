<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Application\Sonata\UserBundle\Controller;

use Application\Sonata\UserBundle\Entity\User;
use Application\Sonata\UserBundle\Form\Handler\RegistrationFormHandler;
use Application\Sonata\UserBundle\Form\Type\RegistrationFormType;
use Pn\PnBundle\Entity\Babysitter;
use Pn\PnBundle\Entity\Pparent;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use FOS\UserBundle\Model\UserInterface;


class RegistrationFOSUser1Controller extends \Sonata\UserBundle\Controller\RegistrationFOSUser1Controller
{

    public function registerAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $request = $this->container->get('request');
        $user = $this->container->get('security.context')->getToken()->getUser();

        if ($user instanceof UserInterface) {
            $this->container->get('session')->getFlashBag()->set('sonata_user_error', 'sonata_user_already_authenticated');
            $url = $this->container->get('router')->generate('sonata_user_profile_show');

            return new RedirectResponse($url);
        }

        $form = $this->container->get('form.factory')->create(new RegistrationFormType("Application\Sonata\UserBundle\Entity\User"));
        $formHandler = new RegistrationFormHandler(
            $form,
            $request,
            $this->container->get('fos_user.user_manager'),
            $this->container->get('fos_user.mailer.default'),
            $this->container->get('fos_user.util.token_generator')
        );

        if ($request->getMethod()=='POST')
        {
            $process = $formHandler->process(true);
            if ($process) {
                $user = $form->getData();

                if ($user->getType() == 'parent')
                {
                    $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneByName('parent');
                    $user->addGroup($group);
                    $parent = new Pparent();
                    $parent->setUser($user);
                    $em->persist($parent);
                }
                if ($user->getType() == 'nounou')
                {
                    $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneByName('nounou');
                    $user->addGroup($group);
                    $babysitter = new Babysitter();
                    $babysitter->setUser($user);
                    $babysitter->setCategory($user->getSecondType());
                    $em->persist($babysitter);
                }
                // Persist in DB
                $em->persist($user);
                $em->flush();

                $response['success'] = true;
                $response['message'] = "Un e-mail vous a été envoyé. Il contient un lien d'activation sur lequel il vous faudra cliquer afin d'activer votre compte.";
                return new JsonResponse( $response );
            }
            else
            {
                $response['success'] = false;
                $response['message'] = 'Votre compte n\'a pas pu etre créé';
                return new JsonResponse( $response );
            }
        }


        return $this->container->get('templating')->renderResponse('ApplicationSonataUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
