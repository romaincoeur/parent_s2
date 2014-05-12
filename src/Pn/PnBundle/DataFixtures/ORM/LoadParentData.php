<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:36
 */

// src/Pn/PnBundle/DataFixtures/ORM/LoadParentData.php
namespace Pn\PnBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Pn\PnBundle\Entity\Pparent;

class LoadParentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $parent_anna = new Pparent();
        $parent_anna->setUser($em->merge($this->getReference('user-anna')));

        $parent_tom = new Pparent();
        $parent_tom->setUser($em->merge($this->getReference('user-tom')));

        $em->persist($parent_anna);
        $em->persist($parent_tom);

        $em->flush();

        $this->addReference('parent-anna', $parent_anna);
        $this->addReference('parent-tom', $parent_tom);
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}