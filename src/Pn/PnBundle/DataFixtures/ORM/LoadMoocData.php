<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:36
 */

// src/Pn/PnBundle/DataFixtures/ORM/LoadMoocData.php
namespace Pn\PnBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Pn\PnBundle\Entity\Mooc;

class LoadMoocData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {

    }

    public function getOrder()
    {
        return 5; // the order in which fixtures will be loaded
    }
}