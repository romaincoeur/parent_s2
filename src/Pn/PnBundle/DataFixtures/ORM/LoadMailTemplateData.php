<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:36
 */

// src/Pn/PnBundle/DataFixtures/ORM/LoadMailTemplateData.php
namespace Pn\PnBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Pn\PnBundle\Entity\MailTemplate;

class LoadMailTemplateData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $mail1 = new MailTemplate();
        $mail1->setTitle('mail de confirmation');
        $mail1->setVirtualTitle('maildeconfirmation');
        $mail1->setObject('Parent-nounou - Mail de confirmation');
        $mail1->setBody('
        Soyez le bienvenu !<br>
        Pour confirmer votre inscription à Parent-nou cliqez <a href="%URL">ici</a>.
        ');

        $mail2 = new MailTemplate();
        $mail2->setTitle('mail de bienvenue');
        $mail2->setVirtualTitle('maildebienvenue');
        $mail2->setObject('Bienvenue sur Parent-nounou.fr');
        $mail2->setBody('
        Soyez le bienvenu !<br>
        ');

        $mail3 = new MailTemplate();
        $mail3->setTitle('nouveau message');
        $mail3->setVirtualTitle('nouveaumessage');
        $mail3->setObject('Vous avez un nouveau message !');
        $mail3->setBody('
        %SENDER vous a envoyé un message : <br>
        %MESSAGE <br>
        cliquez <a href="%URL">ici</a> pour lui répondre.
        ');

        $em->persist($mail1);
        $em->persist($mail2);
        $em->persist($mail3);

        $em->flush();
    }

    public function getOrder()
    {
        return 6; // the order in which fixtures will be loaded
    }
}