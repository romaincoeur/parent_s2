<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:36
 */

// src/Pn/BlogBundle/DataFixtures/ORM/LoadCategoryData.php
namespace Pn\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Pn\BlogBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $category1 = new Category();
        $category1->setName('new');
        $category1->setIcon('alaune.png');

        $category2 = new Category();
        $category2->setName('alimentation');
        $category2->setIcon('badge-alimentation.png');

        $category3 = new Category();
        $category3->setName('baby');
        $category3->setIcon('badge-baby.png');

        $category4 = new Category();
        $category4->setName('dialogue');
        $category4->setIcon('badge-dialogue.png');

        $category5 = new Category();
        $category5->setName('droit');
        $category5->setIcon('badge-droit.png');

        $category6 = new Category();
        $category6->setName('eveil');
        $category6->setIcon('badge-eveil.png');

        $category7 = new Category();
        $category7->setName('prevention');
        $category7->setIcon('badge-prevention.png');

        $category8 = new Category();
        $category8->setName('psycho');
        $category8->setIcon('badge-psycho.png');

        $category9 = new Category();
        $category9->setName('sante');
        $category9->setIcon('badge-sante.png');


        $em->persist($category1);
        $em->persist($category2);
        $em->persist($category3);
        $em->persist($category4);
        $em->persist($category5);
        $em->persist($category6);
        $em->persist($category7);
        $em->persist($category8);
        $em->persist($category9);

        $em->flush();

        $this->addReference('cat-prevention', $category6);
        $this->addReference('cat-baby', $category3);
        $this->addReference('cat-psycho', $category7);
        $this->addReference('cat-new', $category1);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}