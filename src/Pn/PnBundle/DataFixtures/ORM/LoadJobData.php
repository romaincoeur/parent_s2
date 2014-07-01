<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 26/03/14
 * Time: 09:58
 */



// src/Pn/PnBundle/DataFixtures/ORM/LoadJobData.php


namespace Pn\PnBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Pn\PnBundle\Entity\Job;

class LoadJobData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $job1 = new Job();
        $job1->setTitle('Animatrice pour anniversaire');
        $job1->setDescription('Je cherche une animatrice ou bien animateur pour animer l\'anniversaire de mon fils Leon et de ses amis.');
        $job1->setHowToApply('Send your resume to fabien.potencier [at] sensio.com');
        $job1->setIsPublic(true);
        $job1->setIsActivated(true);
        $job1->setExpiresAt(new \DateTime('2012-10-10'));
        $job1->setParent($em->merge($this->getReference('parent-anna')));
        $job1->setAddress('4 Cité de Varenne, 75007 Paris, France');
        $job1->setCity('Paris');
        $job1->setPostcode('75007');

        $job2 = new Job();
        $job2->setTitle('Babysitter réguliere à domicile');
        $job2->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.');
        $job2->setHowToApply('Send your resume to fabien.potencier [at] sensio.com');
        $job2->setIsPublic(true);
        $job2->setIsActivated(true);
        $job2->setExpiresAt(new \DateTime('2012-10-10'));
        $job2->setParent($em->merge($this->getReference('parent-tom')));
        $job2->setAddress('239 Avenue Jean Jaurès, 75019 Paris, France');
        $job2->setCity('Paris');
        $job2->setPostcode('75019');


        $em->persist($job1);
        $em->persist($job2);

        $em->flush();
    }

    public function getOrder()
    {
        return 8; // the order in which fixtures will be loaded
    }
}