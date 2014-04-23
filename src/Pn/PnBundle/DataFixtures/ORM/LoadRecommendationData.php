<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:36
 */

// src/Pn/PnBundle/DataFixtures/ORM/LoadRecommendationData.php
namespace Pn\PnBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Pn\PnBundle\Entity\Recommendation;

class LoadRecommendationData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $recommendation1 = new Recommendation();
        $recommendation1->setBody('Sarah est une de mes amies. Nous avons travaillé ensemble dans un centre de loisir
        l\'année derniere. Elle s\'occupait des activités artisitiques. Les enfants étaient tres réceptifs à ses
        conseils et elle n\'a jamais eu besoin de gronder qui que ce soit. Nous étions tres impressionnés.');
        $recommendation1->setGiver($em->merge($this->getReference('user-romain')));
        $recommendation1->setReceiver($em->merge($this->getReference('user-sarah')));

        $recommendation2 = new Recommendation();
        $recommendation2->setBody('Sarah est une fille tres gentille et tres agréable. Les enfants l\'adorent et nous aussi.');
        $recommendation2->setGiver($em->merge($this->getReference('user-anna')));
        $recommendation2->setReceiver($em->merge($this->getReference('user-sarah')));

        $em->persist($recommendation1);
        $em->persist($recommendation2);

        $em->flush();
    }

    public function getOrder()
    {
        return 5; // the order in which fixtures will be loaded
    }
}