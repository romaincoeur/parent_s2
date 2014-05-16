<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:39
 */

// src/Pn/PnBundle/DataFixtures/ORM/LoadUserData.php
namespace Pn\PnBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Pn\PnBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $em)
    {
        $factory = $this->container->get('security.encoder_factory');

        $user1 = new User();
        $user1->setType('nounou');
        $user1->setFirstname('Romain');
        $user1->setLastname('Coeur');
        $user1->setEmail('coeurro@gmail.com');
        $user1->setIsActivated(true);
        $user1->setLatitude(48.8481553);
        $user1->setLongitude(2.3886942);
        $user1->setAddress('24 Passage du Génie, 75012 Paris, France');
        $user1->setCity('Paris');
        $user1->setPostcode('75012');
        $user1->setConfirmed(true);
        $user1->setConfirmationToken('');

        // set password
        $encoder = $factory->getEncoder($user1);
        $encodedPassword = $encoder->encodePassword('Rogvog4', $user1->getSalt());
        $user1->setPassword($encodedPassword);

        $user2 = new User();
        $user2->setType('parent');
        $user2->setFirstname('Anna');
        $user2->setLastname('Stepanoff');
        $user2->setEmail('anna.stepanoff@gmail.com');
        $user2->setIsActivated(true);
        $user2->setConfirmed(true);
        $user2->setConfirmationToken('');

        // set password
        $encoder = $factory->getEncoder($user2);
        $encodedPassword = $encoder->encodePassword('azerty', $user2->getSalt());
        $user2->setPassword($encodedPassword);

        $user_sarah = new User();
        $user_sarah->setType('nounou');
        $user_sarah->setFirstname('Sarah');
        $user_sarah->setLastname('Lenard');
        $user_sarah->setEmail('sarah.lenard@gmail.com');
        $user_sarah->setIsActivated(true);
        $user_sarah->setPhone("06 39 86 64 90");
        $user_sarah->setLatitude(48.8620054);
        $user_sarah->setLongitude(2.3245144);
        $user_sarah->setAddress('Léopold Sedar Senghor, 75001 Paris, France');
        $user_sarah->setCity('Paris');
        $user_sarah->setPostcode('75001');
        $user_sarah->setConfirmed(true);
        $user_sarah->setConfirmationToken('');

        // set password
        $encoder = $factory->getEncoder($user_sarah);
        $encodedPassword = $encoder->encodePassword('azerty', $user_sarah->getSalt());
        $user_sarah->setPassword($encodedPassword);

        $user_manu = new User();
        $user_manu->setType('nounou');
        $user_manu->setFirstname('Emmanuelle');
        $user_manu->setLastname('Gousse');
        $user_manu->setEmail('emmanuelle.gousse@gmail.com');
        $user_manu->setIsActivated(true);
        $user_manu->setPhone("06 34 56 67 87");
        $user_manu->setLatitude(48.8500050);
        $user_manu->setLongitude(2.3353719);
        $user_manu->setAddress('41 Rue Saint-Sulpice, 75006 Paris, France');
        $user_manu->setCity('Paris');
        $user_manu->setPostcode('75006');
        $user_manu->setConfirmed(true);
        $user_manu->setConfirmationToken('');
        // 48.8500050	2.3353719

        // set password
        $encoder = $factory->getEncoder($user_manu);
        $encodedPassword = $encoder->encodePassword('azerty', $user_manu->getSalt());
        $user_manu->setPassword($encodedPassword);

        $user_julie = new User();
        $user_julie->setType('nounou');
        $user_julie->setFirstname('Julie');
        $user_julie->setLastname('Mousse');
        $user_julie->setEmail('julie.mousse@gmail.com');
        $user_julie->setIsActivated(true);
        $user_julie->setPhone("06 34 46 77 87");
        $user_julie->setLatitude(49.25416601);
        $user_julie->setLongitude(4.03211587);
        $user_julie->setAddress('2 Cours Jean-Baptiste Langlet, 51100 Reims, France');
        $user_julie->setCity('Reims');
        $user_julie->setPostcode('51100');
        $user_julie->setConfirmed(true);
        $user_julie->setConfirmationToken('');
        // 48.8500050	2.3353719

        // set password
        $encoder = $factory->getEncoder($user_julie);
        $encodedPassword = $encoder->encodePassword('azerty', $user_julie->getSalt());
        $user_julie->setPassword($encodedPassword);

        $user_tom = new User();
        $user_tom->setType('parent');
        $user_tom->setFirstname('Tom');
        $user_tom->setLastname('Edgery');
        $user_tom->setEmail('tom.edgery@gmail.com');
        $user_tom->setIsActivated(true);
        $user_tom->setPhone("06 34 26 76 87");
        $user_tom->setConfirmed(true);
        $user_tom->setConfirmationToken('');
        // 48.8500050	2.3353719

        // set password
        $encoder = $factory->getEncoder($user_tom);
        $encodedPassword = $encoder->encodePassword('azerty', $user_tom->getSalt());
        $user_tom->setPassword($encodedPassword);



        $em->persist($user1);
        $em->persist($user2);
        $em->persist($user_sarah);
        $em->persist($user_manu);
        $em->persist($user_julie);
        $em->persist($user_tom);


        $lon_min = -1.0522795;
        $lon_max = 6.7260408;
        $lat_min = 42.4838724;
        $lat_max = 49.6637400;
        for ($i=1;$i<=10;$i++)
        {
            $user_test = new User();
            $user_test->setType('nounou');
            $user_test->setFirstname('test');
            $user_test->setLastname($i);
            $user_test->setEmail('test.'.$i.'@gmail.com');
            $user_test->setIsActivated(true);
            $user_test->setPhone("06 34 4".$i." 77 87");
            $user_test->setLatitude((mt_rand() / mt_getrandmax())*($lat_max-$lat_min) + $lat_min);
            $user_test->setLongitude((mt_rand() / mt_getrandmax())*($lon_max-$lon_min) + $lon_min);
            $user_test->setAddress('');
            $user_test->setConfirmed(true);
            $user_test->setConfirmationToken('');
            // 48.8500050	2.3353719

            // set password
            $encoder = $factory->getEncoder($user_test);
            $encodedPassword = $encoder->encodePassword('azerty', $user_test->getSalt());
            $user_test->setPassword($encodedPassword);

            $em->persist($user_test);
            $this->addReference('user-test'.$i, $user_test);
        }


        $em->flush();

        $this->addReference('user-romain', $user1);
        $this->addReference('user-anna', $user2);
        $this->addReference('user-sarah', $user_sarah);
        $this->addReference('user-manue', $user_manu);
        $this->addReference('user-julie', $user_julie);
        $this->addReference('user-tom', $user_tom);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}