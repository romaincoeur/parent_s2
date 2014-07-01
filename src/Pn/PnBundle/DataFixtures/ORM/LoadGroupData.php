<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:39
 */

// src/Application/Sonata/UserBundle/DataFixtures/ORM/LoadGroupData.php
namespace Application\Sonata\UserBundle\DataFixtures\ORM;

use Application\Sonata\UserBundle\Entity\Group;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        // group admin
        $group_admin = new Group('admin', array('ROLE_ADMIN','ROLE_SONATA_ADMIN'));
        $this->addReference('group-admin', $group_admin);
        $em->persist($group_admin);

        // group author
        $group_author = new Group('author', array('ROLE_ADMIN'));
        $this->addReference('group-author', $group_author);
        $em->persist($group_author);

        // group nounou
        $group_nounou = new Group('nounou', array('ROLE_USER', 'ROLE_NOUNOU'));
        $this->addReference('group-nounou', $group_nounou);
        $em->persist($group_nounou);

        // group parent
        $group_parent = new Group('parent', array('ROLE_USER', 'ROLE_PARENT'));
        $this->addReference('group-parent', $group_parent);
        $em->persist($group_parent);



        $em->flush();
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}