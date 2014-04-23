<?php

namespace Pn\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pn\BlogBundle\Entity\Article;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{

    /**
     * Lists all Article entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PnBlogBundle:Article')->findAll();

        return $this->render('PnBlogBundle:Article:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Article entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PnBlogBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        return $this->render('PnBlogBundle:Article:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
