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
        $user2->setLatitude(48.8592950);
        $user2->setLongitude(2.3586750);

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
        $user_manu->setLatitude(48.8373803);
        $user_manu->setLongitude(2.3293209);

        // set password
        $encoder = $factory->getEncoder($user_manu);
        $encodedPassword = $encoder->encodePassword('azerty', $user_manu->getSalt());
        $user_manu->setPassword($encodedPassword);

        $em->persist($user1);
        $em->persist($user2);
        $em->persist($user_sarah);
        $em->persist($user_manu);

        $em->flush();

        $this->addReference('user-romain', $user1);
        $this->addReference('user-anna', $user2);
        $this->addReference('user-sarah', $user_sarah);
        $this->addReference('user-manue', $user_manu);
    }

    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}