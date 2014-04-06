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
        $mooc1 = new Mooc();
        $mooc1->setTitle('Du geste à la parole');
        $mooc1->setCategory('prevention');
        $mooc1->setPresentation('Les comptines représentent une source majeure d\'apprentissage
        linguistique et culturel des tout-petits. Elles permettent à l\'enfant d\'incorporer');

        $mooc2 = new Mooc();
        $mooc2->setCategory('baby');
        $mooc2->setTitle('Comment choisir son mode de garde');
        $mooc2->setPresentation('Il existe quatre modes de garde principaux pour un enfant de moins de 3 ans');


        $mooc3 = new Mooc();
        $mooc3->setCategory('psycho');
        $mooc3->setTitle('Développement psychomoteur, socio affectif et cognitif de l\'enfant');
        $mooc3->setPresentation('Mener de front vie familiale et vie professionnelle est l\'un des
        principaux défis des femmes d\'aujourdh\'ui' );

        $mooc4 = new Mooc();
        $mooc4->setCategory('new');
        $mooc4->setTitle('La boite à comptines est née !');
        $mooc4->setPresentation('La boite à comptines est une application collaborative de collecte
        et de partage de comptines pour les touts-petits. Son ambition est d\'aider les parent.');


        $em->persist($mooc1);
        $em->persist($mooc2);
        $em->persist($mooc3);
        $em->persist($mooc4);

        $em->flush();
    }

    public function getOrder()
    {
        return 5; // the order in which fixtures will be loaded
    }
}