<?php

namespace Pn\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function viewModuleAction()
    {
        $user = $this->getUser();
        if ($user === null)
        {
            return $this->render('PnUserBundle:Default:notconnected.html.twig');
        }
        else
        {
            return $this->render('PnUserBundle:Default:connected.html.twig');
        }
    }
}
