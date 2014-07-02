<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:36
 */

// src/Pn/PnBundle/DataFixtures/ORM/LoadParentData.php
namespace Pn\PnBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Pn\PnBundle\Entity\Pparent;

class LoadParentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        /*$parent_anna = new Pparent();
        $parent_anna->setUser($em->merge($this->getReference('user-anna')));

        $parent_tom = new Pparent();
        $parent_tom->setUser($em->merge($this->getReference('user-tom')));

        $em->persist($parent_anna);
        $em->persist($parent_tom);

        $em->flush();

        $this->addReference('parent-anna', $parent_anna);
        $this->addReference('parent-tom', $parent_tom);*/

        $parents = array(
            array('id' => '3','user_id' => '202','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '7','user_id' => '207','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '8','user_id' => '208','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '11','user_id' => '213','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '12','user_id' => '224','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '15','user_id' => '228','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '16','user_id' => '242','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '17','user_id' => '243','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '18','user_id' => '248','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '19','user_id' => '249','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '20','user_id' => '252','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '21','user_id' => '255','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '22','user_id' => '256','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '23','user_id' => '261','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '24','user_id' => '271','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '26','user_id' => '276','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '27','user_id' => '280','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '28','user_id' => '291','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '29','user_id' => '298','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '30','user_id' => '304','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '31','user_id' => '306','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '32','user_id' => '314','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '33','user_id' => '333','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL),
            array('id' => '34','user_id' => '349','nbChildren' => NULL,'trustpoints' => NULL,'calendar' => NULL)
        );

        foreach ($parents as $old_parent)
        {
            $new_parent = new Pparent();
            $new_parent->setUser($em->merge($this->getReference('user-'.$old_parent["user_id"])));
            $this->addReference('parent-'.$old_parent["id"], $new_parent);
            $em->persist($new_parent);
        }

        $em->flush();
    }

    public function getOrder()
    {
        return 7; // the order in which fixtures will be loaded
    }
}