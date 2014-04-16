<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:36
 */

// src/Pn/PnBundle/DataFixtures/ORM/LoadMessageData.php
namespace Pn\PnBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Pn\PnBundle\Entity\Message;

class LoadMessageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $message1 = new Message();
        $message1->setBody('Bonjour ca va bien');
        $message1->setSender($em->merge($this->getReference('user-anna')));
        $message1->setReceiver($em->merge($this->getReference('user-romain')));
        $message1->setIsRead(true);

        $message2 = new Message();
        $message2->setBody('Non.');
        $message2->setSender($em->merge($this->getReference('user-romain')));
        $message2->setReceiver($em->merge($this->getReference('user-anna')));
        $message2->setIsRead(true);

        $message3 = new Message();
        $message3->setBody('Sarah est une de mes amies. Nous avons travaillé ensemble dans un centre de loisir l\'année
        derniere. Elle s\'occupait des activités artisitiques. Les enfants étaient tres réceptifs à ses conseils et elle
        n\'a jamais eu besoin de gronder qui que ce soit. Nous étions tres impressionnés.');
        $message3->setSender($em->merge($this->getReference('user-anna')));
        $message3->setReceiver($em->merge($this->getReference('user-romain')));
        $message3->setIsRead(true);

        $message4 = new Message();
        $message4->setBody('Sarah est une fille tres gentille et tres agréable. Les enfants l\'adorent et nous aussi.');
        $message4->setSender($em->merge($this->getReference('user-romain')));
        $message4->setReceiver($em->merge($this->getReference('user-anna')));
        $message4->setIsRead(true);

        $message5 = new Message();
        $message5->setBody('Salut');
        $message5->setSender($em->merge($this->getReference('user-romain')));
        $message5->setReceiver($em->merge($this->getReference('user-manue')));
        $message5->setIsRead(true);

        $message6 = new Message();
        $message6->setBody('Ca va ?');
        $message6->setSender($em->merge($this->getReference('user-manue')));
        $message6->setReceiver($em->merge($this->getReference('user-romain')));
        $message6->setIsRead(true);



        $em->persist($message1);
        $em->persist($message2);
        $em->persist($message3);
        $em->persist($message4);
        $em->persist($message5);
        $em->persist($message6);

        $em->flush();
    }

    public function getOrder()
    {
        return 7; // the order in which fixtures will be loaded
    }
}