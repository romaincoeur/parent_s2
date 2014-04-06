<?php

namespace Pn\PnBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pn\PnBundle\Entity\Mooc;

/**
 * Mooc controller.
 *
 */
class MoocController extends Controller
{

    /**
     * Lists all Mooc entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PnPnBundle:Mooc')->findAll();

        return $this->render('PnPnBundle:Mooc:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Mooc entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnPnBundle:Mooc')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mooc entity.');
        }

        return $this->render('PnPnBundle:Mooc:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
