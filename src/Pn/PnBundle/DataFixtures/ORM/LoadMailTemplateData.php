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
        Bonjour %FIRSTNAME,<br>
        Bienvenu sur parent-nounou.fr – communauté des parents, nounous et baby-sitters soucieux du bien-être et de l’éveil de leurs enfants.<br>
        <br>
        Confirmez votre adresse email en cliquant <a href="%URL">ici</a>.<br>
        <br>
        Voici vos identifiants<br>
        Identifiant email : %EMAIL<br>
        <br>
        A bientôt,<br>
        L’équipe de parent-nounou.fr
        ');



        $mail2 = new MailTemplate();
        $mail2->setTitle('mail de bienvenue');
        $mail2->setVirtualTitle('maildebienvenue');
        $mail2->setObject('Bienvenue sur Parent-nounou.fr');
        $mail2->setBody('
        Bonjour %FIRSTNAME,<br>
        <br>
        Nous sommes heureux de vous compter parmi les membres de notre communauté des nounous, baby-sitters et parents soucieux du bien-être et de l’éveil de l’enfant.<br>
        <br>
        N\'hésitez pas à nous contacter, si vous avez des questions ou avez besoin de notre aide.<br>
        <br>
        L\'équipe de parent-nounou.fr
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

        $mail4 = new MailTemplate();
        $mail4->setTitle('Mail d\'oubli de mot de passe');
        $mail4->setVirtualTitle('resetPasswordMail');
        $mail4->setObject('Parent-nounou.fr - Demande de mot de passe');
        $mail4->setBody('
        Bonjour %FIRSTNAME,<br>
        <br>
        Voici votre identifiant et votre nouveau mot de passe.<br>
        Identifiant email : %EMAIL<br>
        Mot de passe : %PASSWORD<br>
        <br>
        A bientôt,<br>
        L\'équipe de parent-nounou.fr<br>
        ');

        $mail5 = new MailTemplate();
        $mail5->setTitle('Mail de contact');
        $mail5->setVirtualTitle('contactMail');
        $mail5->setObject('Message de contact');
        $mail5->setBody('
        Utilisateur : %FIRSTNAME %LASTNAME <br>
        Email : %EMAIL <br>
        Message : %MESSAGE <br>
        ');

        $mail6 = new MailTemplate();
        $mail6->setTitle('Nouvelle recommendation');
        $mail6->setVirtualTitle('newRecommandation');
        $mail6->setObject('Vous avez été recommandé !');
        $mail6->setBody('
        %SENDER vous a laissé une recommandation : <br>
        %MESSAGE <br>
        cliquez <a href="%URL">ici</a> pour la voir.
        ');

        $em->persist($mail1);
        $em->persist($mail2);
        $em->persist($mail3);
        $em->persist($mail4);
        $em->persist($mail5);
        $em->persist($mail6);

        $em->flush();
    }

    public function getOrder()
    {
        return 9; // the order in which fixtures will be loaded
    }
}