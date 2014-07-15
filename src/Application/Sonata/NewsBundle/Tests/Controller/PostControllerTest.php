<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 07/07/14
 * Time: 04:23
 */

namespace Application\Sonata\NewsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        // Chargement de la page
        $crawler = $client->request('GET', '/blog/');
        $this->assertEquals('Application\Sonata\NewsBundle\Controller\PostController::archiveAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        // Clique sur le premier post
        $link = $crawler->filter('.moocs a')->eq(1)->link();
        $crawler = $client->click($link);
    }
}
