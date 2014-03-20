<?php

namespace Pn\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PnCoreBundle:Default:index.html.twig');
    }

    public function annoncesAction()
    {
        $request = $this->get('request');

        $select = $request->get('searchType');
        $field = $request->get('field');

        if ($select == 'nounou')
        {
            return $this->render('PnCoreBundle:Default:annonce-list.html.twig');
        }
        else
        {
            return $this->render('PnCoreBundle:Default:job-list.html.twig');
        }
    }

    public function profileBabysitterViewAction()
    {
        return $this->render('PnCoreBundle:Default:profileBabysitterView.html.twig');
    }

    public function profileBabysitterEditAction()

    {
        $user = $this->getUser();

        if ($user->type == 'parent')
        {
            return $this->render('PnCoreBundle:Default:profileParentEdit.html.twig');
        }
        else if ($user->type == 'nounou')
        {
            return $this->render('PnCoreBundle:Default:profileBabysitterEdit.html.twig');
        }
        else
        {
            //Todo : Throw error
        }
    }
}
