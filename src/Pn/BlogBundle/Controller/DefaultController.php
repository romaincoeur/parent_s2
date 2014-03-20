<?php

namespace Pn\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PnBlogBundle:Default:index.html.twig', array('name' => $name));
    }
}
