<?php
// src/Pn/PnBundle/DataFixtures/ORM/LoadUserData.php


namespace Pn\PnBundle\DataFixtures\ORM;

use Application\Sonata\UserBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
        $factory = $this->getSecurityManager();
        $faker = $this->getFaker();

        // user romain
        $user1 = new User();
        $user1->addGroup($em->merge($this->getReference('group-admin')));
        $user1->addGroup($em->merge($this->getReference('group-nounou')));
        $user1->setUsername('romain');
        $user1->setFirstname('Romain');
        $user1->setLastname('Coeur');
        $user1->setEmail('coeurro@gmail.com');
        $user1->setEnabled(true);
        $user1->setSuperAdmin(true);
        $user1->setLocked(false);
        $this->addReference('user-romain', $user1);
        $user1->setLatitude(48.8481553);
        $user1->setLongitude(2.3886942);
        $user1->setAddress('24 Passage du Génie, 75012 Paris, France');
        $user1->setCity('Paris');
        $user1->setPostcode('75012');
        //$user1->setConfirmed(true);
        //$user1->setConfirmationToken('');
        $encoder = $factory->getEncoder($user1);
        $encodedPassword = $encoder->encodePassword('Rogvog4', $user1->getSalt());
        $user1->setPassword($encodedPassword);
        $em->persist($user1);

        // user anna
        $user2 = new User();
        $user2->addGroup($em->merge($this->getReference('group-admin')));
        $user2->addGroup($em->merge($this->getReference('group-parent')));
        $user2->addGroup($em->merge($this->getReference('group-author')));
        $user2->setUsername('anna');
        $user2->setFirstname('Anna');
        $user2->setLastname('Stepanoff');
        $user2->setEmail('anna.stepanoff@gmail.com');
        $user2->setEnabled(true);
        $user2->setSuperAdmin(true);
        $user2->setLocked(false);
        $this->addReference('user-anna', $user2);
        //$user2->setConfirmationToken('');
        $encoder = $factory->getEncoder($user2);
        $encodedPassword = $encoder->encodePassword('azerty', $user2->getSalt());
        $user2->setPassword($encodedPassword);
        $em->persist($user2);

        // user sarah
        $user_sarah = new User();
        $user_sarah->addGroup($em->merge($this->getReference('group-nounou')));
        $user_sarah->setFirstname('Sarah');
        $user_sarah->setLastname('Lenard');
        $user_sarah->setEmail('sarah.lenard@gmail.com');
        $user_sarah->setEnabled(true);
        $user_sarah->setPhone("06 39 86 64 90");
        $this->addReference('user-sarah', $user_sarah);
        $user_sarah->setLatitude(48.8620054);
        $user_sarah->setLongitude(2.3245144);
        $user_sarah->setAddress('Léopold Sedar Senghor, 75001 Paris, France');
        $user_sarah->setCity('Paris');
        $user_sarah->setPostcode('75001');
        //$user_sarah->setConfirmed(true);
        //$user_sarah->setConfirmationToken('');
        $encoder = $factory->getEncoder($user_sarah);
        $encodedPassword = $encoder->encodePassword('azerty', $user_sarah->getSalt());
        $user_sarah->setPassword($encodedPassword);
        $em->persist($user_sarah);

        //user manu
        $user_manue = new User();
        $user_manue->addGroup($em->merge($this->getReference('group-nounou')));
        $user_manue->addGroup($em->merge($this->getReference('group-author')));
        $user_manue->setFirstname('Emmanuelle');
        $user_manue->setLastname('Gousse');
        $user_manue->setEmail('emmanuelle.gousse@gmail.com');
        $user_manue->setEnabled(true);
        $user_manue->setPhone("06 34 56 67 87");
        $this->addReference('user-manue', $user_manue);
        $user_manue->setLatitude(48.8500050);
        $user_manue->setLongitude(2.3353719);
        $user_manue->setAddress('41 Rue Saint-Sulpice, 75006 Paris, France');
        $user_manue->setCity('Paris');
        $user_manue->setPostcode('75006');
        //$user_manue->setConfirmed(true);
        //$user_manue->setConfirmationToken('');
        // 48.8500050	2.3353719
        $encoder = $factory->getEncoder($user_manue);
        $encodedPassword = $encoder->encodePassword('azerty', $user_manue->getSalt());
        $user_manue->setPassword($encodedPassword);
        $em->persist($user_manue);

        $user_julie = new User();
        $user_julie->addGroup($em->merge($this->getReference('group-nounou')));
        $user_julie->setFirstname('Julie');
        $user_julie->setLastname('Mousse');
        $user_julie->setEmail('julie.mousse@gmail.com');
        $user_julie->setEnabled(true);
        $user_julie->setPhone("06 34 46 77 87");
        $this->addReference('user-julie', $user_julie);
        $user_julie->setLatitude(49.25416601);
        $user_julie->setLongitude(4.03211587);
        $user_julie->setAddress('2 Cours Jean-Baptiste Langlet, 51100 Reims, France');
        $user_julie->setCity('Reims');
        $user_julie->setPostcode('51100');
        //$user_julie->setConfirmed(true);
        //$user_julie->setConfirmationToken('');
        // 48.8500050	2.3353719
        $encoder = $factory->getEncoder($user_julie);
        $encodedPassword = $encoder->encodePassword('azerty', $user_julie->getSalt());
        $user_julie->setPassword($encodedPassword);
        $em->persist($user_julie);

        $user_tom = new User();
        $user_tom->addGroup($em->merge($this->getReference('group-parent')));
        $user_tom->setFirstname('Tom');
        $user_tom->setLastname('Edgery');
        $user_tom->setEmail('tom.edgery@gmail.com');
        $user_tom->setEnabled(true);
        $user_tom->setPhone("06 34 26 76 87");
        $this->addReference('user-tom', $user_tom);
        //$user_tom->setConfirmed(true);
        //$user_tom->setConfirmationToken('');
        // 48.8500050	2.3353719
        $encoder = $factory->getEncoder($user_tom);
        $encodedPassword = $encoder->encodePassword('azerty', $user_tom->getSalt());
        $user_tom->setPassword($encodedPassword);
        $em->persist($user_tom);


        $lon_min = -1.0522795;
        $lon_max = 6.7260408;
        $lat_min = 42.4838724;
        $lat_max = 49.6637400;
        foreach (range(1, 20) as $id) {
            $user = new User();
            $user->setUsername($faker->userName);
            $user->addGroup($em->merge($this->getReference('group-nounou')));
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail($faker->safeEmail);
            $user->setPhone($faker->phoneNumber);
            $user->setLatitude((mt_rand() / mt_getrandmax())*($lat_max-$lat_min) + $lat_min);
            $user->setLongitude((mt_rand() / mt_getrandmax())*($lon_max-$lon_min) + $lon_min);
            $user->setAddress('');
            $user->setPlainPassword($faker->randomNumber());
            $user->setEnabled(true);
            $user->setLocked(false);
            $this->addReference('user-'.$id, $user);
            $encoder = $factory->getEncoder($user);
            $encodedPassword = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
            $user->setPassword($encodedPassword);
            $em->persist($user);
        }

        $em->flush();
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }

    /**
     * @return \FOS\UserBundle\Model\UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->container->get('fos_user.user_manager');
    }

    /**
     * @return \Symfony\Component\Security\Core\Encoder\EncoderFactory
     */
    public function getSecurityManager()
    {
        return $this->container->get('security.encoder_factory');
    }

    /**
     * @return \Faker\Generator
     */
    public function getFaker()
    {
        return $this->container->get('faker.generator');
    }
}