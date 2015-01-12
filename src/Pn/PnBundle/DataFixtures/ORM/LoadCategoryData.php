<?php
// src/Pn/PnBundle/DataFixtures/ORM/LoadCategoryData.php


namespace Pn\PnBundle\DataFixtures\ORM;

use Application\Sonata\ClassificationBundle\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $em)
    {

        // user romain
        $cat1 = new Category();
        $cat1->setName('default');
        $cat1->setEnabled(true);
        $this->addReference('cat-default', $cat1);
        $em->persist($cat1);
        $em->flush();
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}