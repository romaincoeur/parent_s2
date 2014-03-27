<?php


// src/Pn/PnBundle/DataFixtures/ORM/LoadBabysittercategoryData.php


namespace Pn\PnBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Pn\PnBundle\Entity\Babysittercategory;

class LoadBabysittercategoryData extends AbstractFixture implements OrderedFixtureInterface
{
  public function load(ObjectManager $em)
  {
    $design = new Babysittercategory();
    $design->setTitle('Animatrice');

    $programming = new Babysittercategory();
    $programming->setTitle('Babysitter');

    $manager = new Babysittercategory();
    $manager->setTitle('Fille au Pair');

    $administrator = new Babysittercategory();
    $administrator->setTitle('Nounou');

    $em->persist($design);
    $em->persist($programming);
    $em->persist($manager);
    $em->persist($administrator);

    $em->flush();

    $this->addReference('category-animatrice', $design);
    $this->addReference('category-babysitter', $programming);
    $this->addReference('category-aupair', $manager);
    $this->addReference('category-nounou', $administrator);
  }

  public function getOrder()
  {
    return 1; // the order in which fixtures will be loaded
  }
}