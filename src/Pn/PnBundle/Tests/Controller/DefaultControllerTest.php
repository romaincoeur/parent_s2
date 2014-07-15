<?php

namespace Pn\PnBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class DefaultControllerTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = static::createClient();

        // Chargement de la page
        $crawler = $client->request('GET', '/');
        $this->assertEquals('Pn\PnBundle\Controller\DefaultController::indexAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        // Blog Posts
        $this->assertCount(4, $crawler->filter('.new'));
    }

    public function testTeamPage()
    {
        $client = static::createClient();

        // Chargement de la page
        $crawler = $client->request('GET', '/qui-sommes-nous');
        $this->assertEquals('Pn\PnBundle\Controller\DefaultController::teamAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testCGUPage()
    {
        $client = static::createClient();

        // Chargement de la page
        $crawler = $client->request('GET', '/mentions-legales');
        $this->assertEquals('Pn\PnBundle\Controller\DefaultController::cguAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
        $this->assertCount(1, $crawler->filter('h1:contains("Mentions légales")'));
    }
}
