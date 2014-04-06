<?php

namespace Pn\PnBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Dashboard controller.
 *
 */
class DashboardController extends Controller
{

    /**
     * Liste les annonces
     *
     */
    public function indexAction()
    {
        $user = $this->getUser();

        if ($user->getType() == 'nounou')
        {
            return $this->render('PnPnBundle:Dashboard:annonces-babysitter.html.twig');
        }
        elseif ($user->getType() == 'parent')
        {
            return $this->render('PnPnBundle:Dashboard:annonces-parent.html.twig');
        }
        else
        {
            throw $this->createNotFoundException('Wrong user type.');
        }
    }

    /**
     * Liste les revenus de la nounou
     *
     */
    public function revenusAction()
    {
        $user = $this->getUser();

        return $this->render('PnPnBundle:Dashboard:revenus.html.twig');
    }

    /**
     * Liste les paiements des parents
     *
     */
    public function paiementsAction()
    {
        $user = $this->getUser();

        return $this->render('PnPnBundle:Dashboard:paiements.html.twig');
    }

}
