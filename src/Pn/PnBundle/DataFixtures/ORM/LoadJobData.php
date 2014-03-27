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
        $job1->setDescription('<p>Je m\'appelle Clémentine, j\'ai 28 ans, je suis animatrice pour enfants et comédienne.
        J\'ai mon BAFA, et j\'ai été cheftaine scout et animatrice de centre de loisir pendant plusieurs années. A
        présent, je propose des animations de goûter d\'anniversaire : je maquille les enfants puis j\'organise des
        jeux sur un thème de conte de fée, afin de préparer les enfants au spectacle de marionnettes qui va suivre.
        Vous pourrez choisir des contes célèbres comme Pinocchio, le Petit Chaperon rouge, et aussi des contes plus
        rares du folklore Russe avec les histoires de la sorcière Babayaga ou de la princesse Vassilissa... Pour les
         petits je présenterai aussi des comptines et fables plus courtes avec des marionnettes en forme d\'animaux.
         Je propose également des spectacles d\'ombre chinoises...</p>
         <p>Enfin, je jouerai à partir du 8 janvier dans un joli spectacle théâtral et musical pour enfant à la Comédie de
         la Passerelle : La Sorcière Polluair et le petit peuple vert !</p>');
        $job1->setHowToApply('Send your resume to fabien.potencier [at] sensio.com');
        $job1->setIsPublic(true);
        $job1->setIsActivated(true);
        $job1->setToken('job_sensio_labs');
        $job1->setExpiresAt(new \DateTime('2012-10-10'));

        $job2 = new Job();
        $job2->setTitle('Babysitter réguliere à domicile');
        $job2->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.');
        $job2->setHowToApply('Send your resume to fabien.potencier [at] sensio.com');
        $job2->setIsPublic(true);
        $job2->setIsActivated(true);
        $job2->setToken('job_extreme_sensio');
        $job2->setExpiresAt(new \DateTime('2012-10-10'));


        $em->persist($job1);
        $em->persist($job2);

        $em->flush();
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}