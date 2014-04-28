<?php

namespace Pn\PnBundle\Controller;

use Pn\PnBundle\Entity\Babysitter;
use Pn\PnBundle\Entity\Pparent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Pn\PnBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Pn\PnBundle\Form\UserType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\JsonResponse;
use Pn\PnBundle\Form\ChangePasswordType;
use Pn\PnBundle\Form\Model\ChangePassword;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $babysitters = $em->getRepository('PnPnBundle:User')->getLastBabysitters(3);

        $articles = $em->getRepository('PnBlogBundle:Article')->getLatest(4);

        $nounous = $em->getRepository('PnPnBundle:Babysitter')->findAll();

        return $this->render('PnPnBundle:Default:index.html.twig', array(
            'babysitters' => $babysitters,
            'nounous' => $nounous,
            'articles' => $articles
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
            $form = $this->createCreateForm($entity);

            return $this->render('PnPnBundle:Default:notconnected.html.twig', array(
                'entity' => $entity,
                'register_form'   => $form->createView(),
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
            $parent = $this->getUser()->getParent();
            $em = $this->getDoctrine()->getManager();
            $currentAnnonce = $em->getRepository('PnPnBundle:Job')->getAnnonce($parent);

            if ($currentAnnonce == null)
            {
                return $this->redirect($this->generateUrl('pn_job_new'));
            }
            else
            {
                return $this->redirect($this->generateUrl('pn_job_show', array('id' => $currentAnnonce[0]->getId())));
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
            return $this->redirect($this->generateUrl('pn_job_new'));
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

        if ($select == 'nounou')
        {
            return $this->redirect($this->generateUrl('babysitter_search', array('search' => $field)));
        }
        else
        {
            return $this->redirect($this->generateUrl('pn_job', array('search' => $field)));
        }
    }
}
