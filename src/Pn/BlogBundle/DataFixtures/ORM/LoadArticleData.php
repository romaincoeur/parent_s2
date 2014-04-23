<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:36
 */

// src/Pn/BlogBundle/DataFixtures/ORM/LoadArticleData.php
namespace Pn\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Pn\BlogBundle\Entity\Article;

class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $article1 = new Article();
        $article1->setTitle('Du geste à la parole');
        $article1->setCategory($em->merge($this->getReference('cat-prevention')));
        $article1->setPresentation('Les comptines représentent une source majeure d\'apprentissage
        linguistique et culturel des tout-petits. Elles permettent à l\'enfant d\'incorporer');

        $article2 = new Article();
        $article2->setCategory($em->merge($this->getReference('cat-baby')));
        $article2->setTitle('Comment choisir son mode de garde');
        $article2->setPresentation('Il existe quatre modes de garde principaux pour un enfant de moins de 3 ans');


        $article3 = new Article();
        $article3->setCategory($em->merge($this->getReference('cat-psycho')));
        $article3->setTitle('Développement psychomoteur, socio affectif et cognitif de l\'enfant');
        $article3->setPresentation('Mener de front vie familiale et vie professionnelle est l\'un des
        principaux défis des femmes d\'aujourdh\'ui' );

        $article4 = new Article();
        $article4->setCategory($em->merge($this->getReference('cat-new')));
        $article4->setTitle('La boite à comptines est née !');
        $article4->setPresentation('La boite à comptines est une application collaborative de collecte
        et de partage de comptines pour les touts-petits. Son ambition est d\'aider les parent.');


        $em->persist($article1);
        $em->persist($article2);
        $em->persist($article3);
        $em->persist($article4);

        $em->flush();
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}