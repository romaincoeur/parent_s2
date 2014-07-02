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
        /*$job1 = new Job();
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
        $em->persist($job2);*/


        $jobs = array(
            array('id' => '2','parent_id' => '11','title' => 'Garde d\'enfant à Nice !!! URGENT !!!','status' => 'annonce','description' => 'Garde d\'enfant à Nice !!! URGENT !!!

Les besoins
périscolaire (sortie d\'école, le mercredi...)
baby-sitting (en soirée, le week-end...)
pendant les vacances scolaires
garde temps plein (enfant non scolarisé)
besoin ponctuel (dépannage, mariage, événement...)

Les enfants
un enfant de 3 ans
un enfant de 5 ans

Je recherche urgemment une personne de confiance pour garder 2 enfants à Nice.
Si vous êtes disponible et que votre profil correspond aux besoins détaillés ci-dessus, merci de me faire parvenir votre candidature.

A bientôt,

Paulette','address' => '7 Place du Général de Gaulle, 06100 Nice, France','unacurateAddress' => 'Liberation, Nice, France','postcode' => '06100','departement' => NULL,'city' => 'Nice','latitude' => '43.71017280','longitude' => '7.26195320','rate_price' => '25.00','rate_type' => 'hour','duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)        (0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)        (0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)        (0000000)(0000000)]','is_public' => '1','is_activated' => '1','expires_at' => '2014-12-31 00:00:00','created_at' => '2014-05-20 15:53:57','updated_at' => '2014-05-20 23:29:45','category' => 'nounou','experience' => '0','start' => '2014-05-20','end' => '2014-05-20','diplomas' => 'a:0:{}','ageofchildren' => 'a:0:{}','languages' => 'a:0:{}','petitsplus' => 'a:0:{}','extraTasks' => 'a:0:{}','particularite' => 'a:0:{}','phone' => NULL),
            array('id' => '3','parent_id' => '15','title' => 'Garde d\'enfant à domicile','status' => 'annonce','description' => 'Nous sommes 2 enfants : Rosanna, 9 ans, et Enzo,5 ans.
Nous recherchons un nounou pour sorties du centre de loisir (18h30-19h00),à partir du 1 er septembre, les 2 dernière semaine de chaque mois (jusqu\'à 21h00)
La nounou doit:
Nous aider aux devoir
Nous préparer le dîner
Nous donner le bain','address' => '5 Place Jean Jaurès, 93200 Saint-Denis, France','unacurateAddress' => 'Saint-Denis, France','postcode' => '93200','departement' => NULL,'city' => 'Saint-Denis','latitude' => '48.93618100','longitude' => '2.35744300','rate_price' => '10.00','rate_type' => 'hour','duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(1111100)(1111100)(1111100)(0000000)(0000000)(0000000)(0000000)]','is_public' => '1','is_activated' => '1','expires_at' => '2014-07-31 00:00:00','created_at' => '2014-05-20 16:03:41','updated_at' => '2014-06-20 22:05:46','category' => 'babysitter','experience' => '0','start' => '2014-05-20','end' => '2014-05-20','diplomas' => 'a:0:{}','ageofchildren' => 'a:2:{i:0;s:1:"2";i:1;s:1:"3";}','languages' => 'a:1:{i:0;s:2:"fr";}','petitsplus' => 'a:0:{}','extraTasks' => 'a:2:{i:0;s:8:"homework";i:1;s:7:"cooking";}','particularite' => 'a:0:{}','phone' => NULL),
            array('id' => '6','parent_id' => '3','title' => 'Russian or English speaking "fille au pair" needed','status' => 'annonce','description' => 'Announcement in English and Russian.

Hi, we are looking for a Russian or English speaking "jeune fille au pair" of 20-30 years old, starting from september 2014 for a year or more. You can arrive in August - we would even prefer that. You will take care o 2 kids of 6 and 2 years old : a boy and a girl. Kids do to school and kindergardern, so you will mostly get them from school at around 18h and take care of them up until going to bed.  Sometimes you will take care of them the whole day on Wednesday (there is no school on Wednesday) and on some week-ends. On certain days, you will bring them to school as well in the morning. Sometimes, you will help us with cooking or housekeeping, but there is another persone who comes once a week for housekeeping specifically. It is very important that you have a driving license, as you need to take a car to go to kids\' school. You should either an English native speaker with intermediate knowledge of French (kids do not speak English, but we would like them to learn) or a Russian native speaker with some basic knowledge of French (kids do speak Russian and we want them to practice).

You will stay and eat with us in our house in countryside, you will have a separate room. We are a franco-russian family. We will help you learn French and we can bring you with us travel a bit in France if you desire.

We are looking for somebody with many ideas of activities to play with kids, smbd who likes nature (we are really in a countryside). There is horse farm near, so you can practice horse riding if you wish. During the day, you can study French (or smth else) in Chartres (20 min by train from us, 40 min by car), or you can learn computer coding in La Loupe as there is a computer coding school nearby.

Contact me if you are interested !

**************************************************************

Здравствуйте, я ищу русско-язычную или англо-язычную девушку AU PAIR, 20-30 лет, с сентября 2014 (можно и даже желательно начать с августа) на год во Франции (1 час 30 от Парижа) для двоих детей 6 и 2 года - мальчик и девочка. Дети ходят в школу и ясли, так что нам необходима помощь в основном вечером (забрать со школы и яслей в 18 часов, покормить, поиграть, покупать и уложить спать). Иногда надо будет детей отвести в школу и ясли утром. Иногда надо будет с ними заниматься по средам (нет школы в среду) и некоторым выходным. У нас уже есть женщина, которая приходит раз в неделю делать уборку в доме, вам не надо будет этим заниматься, просто иногда помогать готовить и немного прибирать на кухне и т.д. Очень важно, чтобы у вас были водительские права, так как детей со школы и яслей надо забирать на машине. Ваш родной язык должен быть или русский (тогда вам надо знать только основы французского чтобы объясниться на улице, дети говорят по-русски) или английский (тогда вам надо знать французский на среднем уровне, так как дети не говорят на английском, но мы хотим чтобы они его выучили).

Мы вам обеспечим питание и проживание в нашем большом доме во французской деревне. У вас будет отдельная комната. Мы франко-русская семья. Вы сможете изучать французский язык в Шартре (20 мин на поезде, 40 мин на машине) или программирование в La Loupe (10 мин от нас) где есть школа программирования. Мы вам поможем в поиске учебы и изучении французского. Вы также сможете с нами немного попутешествовать во Франции на каникулах или некоторых выходных, если желаете.

Мы ищем молодую энергичную девушку умеющую придумать интересные и развивающие занятия для детей, которая любит природу и занятия на улице (велосипед и т.д.). Рядом с нами есть центр конного спорта, так что вы можете учиться верховой езде.

Пишите, если желаете приехать.','address' => 'La Bretecherie, 28240 Saint-Éliph, France','unacurateAddress' => 'Saint-Éliph, France','postcode' => '28240','departement' => NULL,'city' => 'Saint-Éliph','latitude' => '48.44300000','longitude' => '1.05700000','rate_price' => '250.00','rate_type' => 'month','duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(1111100)(1111100)(1111100)(0000000)(0000000)(0000000)(0000000)]','is_public' => '1','is_activated' => '1','expires_at' => NULL,'created_at' => '2014-05-21 13:56:07','updated_at' => '2014-06-20 21:48:23','category' => 'aupair','experience' => '0','start' => '2014-09-01','end' => '2015-06-30','diplomas' => 'a:0:{}','ageofchildren' => 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}','languages' => 'a:2:{i:0;s:2:"ru";i:1;s:2:"en";}','petitsplus' => 'a:1:{i:0;s:9:"promenade";}','extraTasks' => 'a:0:{}','particularite' => 'a:3:{i:0;s:9:"nonfumeur";i:1;s:7:"animaux";i:2;s:6:"permis";}','phone' => NULL),
            array('id' => '9','parent_id' => '18','title' => 'Recherche baby sitter pour soirées occasionnelles','status' => 'annonce','description' => 'Bonjour,
Nous avons trois petits garçons de 2, 4 et 6 ans et nous recherchons une baby sitter pour les garder le soir de temps à autre.
Nous recherchons une personne sérieuse, dynamique et qui sache se faire respecter. Il faudrait s\'occuper du coucher et parfois du repas du soir qui aura été préparé à l\'avance. Ensuite surveillance durant la fin de soirée et parfois jusqu\'à minuit/1h. Nous vous raccompagnerons chez vous mais nous cherchons quelqu\'un qui habite à proximité.
A bientôt !','address' => '3-5 Cour d\'Honneur du Château de Paris Jardins, 91210 Draveil, France','unacurateAddress' => 'Draveil, France','postcode' => '91210','departement' => NULL,'city' => 'Draveil','latitude' => '48.68700000','longitude' => '2.40900000','rate_price' => '10.00','rate_type' => 'hour','duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)        (0000000)        (0000000)        (0000000)        (0000000)        (0000000)        (0000000)        (0000000)        (0000000)        (0000000)        (0000000)        (0000000)        (0000000)        (0000000)        (0','is_public' => '1','is_activated' => '1','expires_at' => NULL,'created_at' => '2014-05-21 19:51:33','updated_at' => '2014-06-20 22:02:33','category' => 'babysitter','experience' => '2','start' => '2014-05-21','end' => '2015-05-21','diplomas' => 'a:0:{}','ageofchildren' => 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}','languages' => 'a:1:{i:0;s:2:"fr";}','petitsplus' => 'a:1:{i:0;s:4:"notv";}','extraTasks' => 'a:0:{}','particularite' => 'a:1:{i:0;s:9:"nonfumeur";}','phone' => '0664981308'),
            array('id' => '13','parent_id' => '26','title' => NULL,'status' => 'annonce','description' => NULL,'address' => NULL,'unacurateAddress' => NULL,'postcode' => NULL,'departement' => NULL,'city' => NULL,'latitude' => NULL,'longitude' => NULL,'rate_price' => NULL,'rate_type' => NULL,'duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0','is_public' => NULL,'is_activated' => NULL,'expires_at' => NULL,'created_at' => '2014-06-20 22:51:51','updated_at' => NULL,'category' => 'nounou','experience' => '0','start' => '2014-06-20','end' => '2014-06-20','diplomas' => 'a:0:{}','ageofchildren' => 'a:0:{}','languages' => 'a:0:{}','petitsplus' => 'a:0:{}','extraTasks' => 'a:0:{}','particularite' => 'a:0:{}','phone' => NULL),
            array('id' => '14','parent_id' => '23','title' => NULL,'status' => 'annonce','description' => NULL,'address' => NULL,'unacurateAddress' => NULL,'postcode' => NULL,'departement' => NULL,'city' => NULL,'latitude' => NULL,'longitude' => NULL,'rate_price' => NULL,'rate_type' => NULL,'duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0','is_public' => NULL,'is_activated' => NULL,'expires_at' => NULL,'created_at' => '2014-06-20 22:53:54','updated_at' => NULL,'category' => 'nounou','experience' => '0','start' => '2014-06-20','end' => '2014-06-20','diplomas' => 'a:0:{}','ageofchildren' => 'a:0:{}','languages' => 'a:0:{}','petitsplus' => 'a:0:{}','extraTasks' => 'a:0:{}','particularite' => 'a:0:{}','phone' => NULL),
            array('id' => '15','parent_id' => '22','title' => 'Nounou à temps partiel dans 75019','status' => 'annonce','description' => 'Recherche une garde à temps partiel dans le 19e à Paris','address' => '18 Rue Melingue, 75019 Paris, France','unacurateAddress' => 'Combat, Paris, France','postcode' => '75019','departement' => NULL,'city' => 'Paris','latitude' => '48.87564530','longitude' => '2.38576520','rate_price' => NULL,'rate_type' => NULL,'duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0','is_public' => NULL,'is_activated' => NULL,'expires_at' => NULL,'created_at' => '2014-06-21 00:18:10','updated_at' => '2014-06-21 00:19:48','category' => 'nounou','experience' => '0','start' => '2014-06-21','end' => '2014-06-21','diplomas' => 'a:0:{}','ageofchildren' => 'a:0:{}','languages' => 'a:0:{}','petitsplus' => 'a:0:{}','extraTasks' => 'a:0:{}','particularite' => 'a:0:{}','phone' => '06 60 86 89 44'),
            array('id' => '16','parent_id' => '21','title' => 'Recherche d\'une garde dans le 19e à Paris','status' => 'annonce','description' => 'Recherche d\'une garde de lundi à vendredi à temps plein dans le 19e à Paris, à domicile, partagée ou chez une assistante maternelle.','address' => '31-35 Rue de Thionville, 75019 Paris, France','unacurateAddress' => 'Pont-de-Flandre, Paris, France','postcode' => '75019','departement' => NULL,'city' => 'Paris','latitude' => '48.89061360','longitude' => '2.38670830','rate_price' => NULL,'rate_type' => NULL,'duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0','is_public' => NULL,'is_activated' => NULL,'expires_at' => NULL,'created_at' => '2014-06-21 00:28:17','updated_at' => '2014-06-21 00:31:31','category' => 'nounou','experience' => '0','start' => '2014-09-01','end' => '2015-07-01','diplomas' => 'a:0:{}','ageofchildren' => 'a:0:{}','languages' => 'a:0:{}','petitsplus' => 'a:0:{}','extraTasks' => 'a:0:{}','particularite' => 'a:0:{}','phone' => '06 20 60 40 33'),
            array('id' => '17','parent_id' => '28','title' => 'Recherche d\'une nounou pour des sorties d\'école','status' => 'annonce','description' => 'Recherche une nounou pour 2 familles pour les sorties d\'école les mardis et vendredis de 16h30 à 19h, plus les mercredi après-midis de 13h30 à 19h. Garde partagée. Plutôt une étudiante.','address' => '33-35 Rue Fessart, 75019 Paris, France','unacurateAddress' => 'Combat, Paris, France','postcode' => '75019','departement' => NULL,'city' => 'Paris','latitude' => '48.87678960','longitude' => '2.38538900','rate_price' => NULL,'rate_type' => NULL,'duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0','is_public' => NULL,'is_activated' => NULL,'expires_at' => NULL,'created_at' => '2014-06-21 00:35:28','updated_at' => '2014-06-21 00:38:14','category' => 'nounou','experience' => '0','start' => '2014-06-21','end' => '2014-06-21','diplomas' => 'a:0:{}','ageofchildren' => 'a:0:{}','languages' => 'a:0:{}','petitsplus' => 'a:0:{}','extraTasks' => 'a:0:{}','particularite' => 'a:0:{}','phone' => '06 58 79 08 72'),
            array('id' => '18','parent_id' => '24','title' => NULL,'status' => 'annonce','description' => NULL,'address' => NULL,'unacurateAddress' => NULL,'postcode' => NULL,'departement' => NULL,'city' => NULL,'latitude' => NULL,'longitude' => NULL,'rate_price' => NULL,'rate_type' => NULL,'duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0','is_public' => NULL,'is_activated' => NULL,'expires_at' => NULL,'created_at' => '2014-06-23 12:22:16','updated_at' => NULL,'category' => 'nounou','experience' => '0','start' => '2014-06-23','end' => '2014-06-23','diplomas' => 'a:0:{}','ageofchildren' => 'a:0:{}','languages' => 'a:0:{}','petitsplus' => 'a:0:{}','extraTasks' => 'a:0:{}','particularite' => 'a:0:{}','phone' => NULL),
            array('id' => '19','parent_id' => '12','title' => NULL,'status' => 'annonce','description' => NULL,'address' => NULL,'unacurateAddress' => NULL,'postcode' => NULL,'departement' => NULL,'city' => NULL,'latitude' => NULL,'longitude' => NULL,'rate_price' => NULL,'rate_type' => NULL,'duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0','is_public' => NULL,'is_activated' => NULL,'expires_at' => NULL,'created_at' => '2014-06-23 13:06:10','updated_at' => NULL,'category' => 'nounou','experience' => '0','start' => '2014-06-23','end' => '2014-06-23','diplomas' => 'a:0:{}','ageofchildren' => 'a:0:{}','languages' => 'a:0:{}','petitsplus' => 'a:0:{}','extraTasks' => 'a:0:{}','particularite' => 'a:0:{}','phone' => NULL),
            array('id' => '23','parent_id' => '27','title' => NULL,'status' => 'annonce','description' => NULL,'address' => NULL,'unacurateAddress' => NULL,'postcode' => NULL,'departement' => NULL,'city' => NULL,'latitude' => NULL,'longitude' => NULL,'rate_price' => NULL,'rate_type' => NULL,'duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0','is_public' => NULL,'is_activated' => NULL,'expires_at' => NULL,'created_at' => '2014-06-24 00:53:21','updated_at' => NULL,'category' => 'nounou','experience' => '0','start' => '2014-06-24','end' => '2014-06-24','diplomas' => 'a:0:{}','ageofchildren' => 'a:0:{}','languages' => 'a:0:{}','petitsplus' => 'a:0:{}','extraTasks' => 'a:0:{}','particularite' => 'a:0:{}','phone' => NULL),
            array('id' => '24','parent_id' => '29','title' => NULL,'status' => 'annonce','description' => NULL,'address' => NULL,'unacurateAddress' => NULL,'postcode' => NULL,'departement' => NULL,'city' => NULL,'latitude' => NULL,'longitude' => NULL,'rate_price' => NULL,'rate_type' => NULL,'duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(1111100)(1111100)(1111100)(1111100)(1111100)(1111100)(1111100)(1111100)(1111100)(1111100)(1111100)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)]','is_public' => NULL,'is_activated' => NULL,'expires_at' => NULL,'created_at' => '2014-06-25 22:17:13','updated_at' => '2014-06-25 22:24:27','category' => 'nounou','experience' => '0','start' => '2014-06-25','end' => '2014-06-25','diplomas' => 'a:0:{}','ageofchildren' => 'a:0:{}','languages' => 'a:0:{}','petitsplus' => 'a:0:{}','extraTasks' => 'a:0:{}','particularite' => 'a:0:{}','phone' => NULL),
            array('id' => '25','parent_id' => '33','title' => 'recherche assistante maternelle','status' => 'annonce','description' => 'nous cherchons une assistante maternelle pour déposer ou récupérer deux jeunes enfants à la blotterie. ','address' => '28 Rue Mansart, 37300 Joué-lès-Tours, France','unacurateAddress' => '37300 Joué-lès-Tours, France','postcode' => '37300','departement' => NULL,'city' => 'Joué-lès-Tours','latitude' => '47.34263125','longitude' => '0.65994832','rate_price' => '3.00','rate_type' => 'hour','duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(1111100)(1111100)(1111100)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(1111100)(1111100)(1111100)(1111100)(0000000)(0000000)(0000000)(0000000)(0000000)]','is_public' => NULL,'is_activated' => NULL,'expires_at' => NULL,'created_at' => '2014-06-29 21:52:32','updated_at' => '2014-06-29 22:02:39','category' => 'assistante','experience' => '1','start' => '2014-09-04','end' => '2015-07-01','diplomas' => 'a:1:{i:0;s:10:"assistante";}','ageofchildren' => 'a:2:{i:0;s:1:"0";i:1;s:1:"2";}','languages' => 'a:1:{i:0;s:2:"fr";}','petitsplus' => 'a:0:{}','extraTasks' => 'a:1:{i:0;s:8:"homework";}','particularite' => 'a:2:{i:0;s:9:"nonfumeur";i:1;s:7:"animaux";}','phone' => '0625522118'),
            array('id' => '26','parent_id' => '34','title' => 'assistante maternelle agree ','status' => 'annonce','description' => 'assistante maternelle agree depuis plus de 10 ans , j abite dans une grande maison a plein pied 110m2 et un grand jardin , beaucoup d activité tout au long de l année , je me fume pas , adore le contacte avec les enfants car ils nous apporte beaucoup de joie .','address' => '214 Rue Étienne Marcel, 93170 Bagnolet, France','unacurateAddress' => '93170 Bagnolet, France','postcode' => '93170','departement' => NULL,'city' => 'Bagnolet','latitude' => '48.85717737','longitude' => '2.42073053','rate_price' => '3.60','rate_type' => 'hour','duration' => NULL,'how_to_apply' => NULL,'calendar' => '[(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)]','is_public' => NULL,'is_activated' => NULL,'expires_at' => NULL,'created_at' => '2014-07-01 17:21:00','updated_at' => '2014-07-01 17:37:38','category' => 'assistante','experience' => '11','start' => '2014-09-01','end' => '2019-12-31','diplomas' => 'a:1:{i:0;s:10:"assistante";}','ageofchildren' => 'a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}','languages' => 'a:1:{i:0;s:2:"fr";}','petitsplus' => 'a:2:{i:0;s:11:"repasmaison";i:1;s:9:"promenade";}','extraTasks' => 'a:1:{i:0;s:8:"homework";}','particularite' => 'a:3:{i:0;s:9:"nonfumeur";i:1;s:6:"permis";i:2;s:7:"voiture";}','phone' => '0665922014')
        );

        foreach ($jobs as $old_job)
        {
            if ($old_job["parent_id"])
            {
                $new_job = new Job();
                $new_job->setParent($em->merge($this->getReference('parent-'.$old_job["parent_id"])));
                $new_job->setTitle($old_job["title"]);
                $new_job->setStatus($old_job["status"]);
                $new_job->setDescription($old_job["description"]);
                $new_job->setAddress($old_job["address"]);
                $new_job->setUnacurateAddress($old_job["unacurateAddress"]);
                $new_job->setPostcode($old_job["postcode"]);
                $new_job->setDepartement($old_job["departement"]);
                $new_job->setCity($old_job["city"]);
                $new_job->setLatitude($old_job["latitude"]);
                $new_job->setLongitude($old_job["longitude"]);
                $new_job->setRatePrice($old_job["rate_price"]);
                $new_job->setRateType($old_job["rate_type"]);
                $new_job->setDuration($old_job["duration"]);
                $new_job->setHowToApply($old_job["how_to_apply"]);
                $new_job->setCalendar($old_job["calendar"]);
                $new_job->setIsActivated($old_job["is_activated"]);
                $new_job->setCreatedAt(\DateTime::createFromFormat ("Y-m-d H:i:s", $old_job["created_at"]));
                if ($old_job["updated_at"])
                    $new_job->setUpdatedAt(\DateTime::createFromFormat ("Y-m-d H:i:s", $old_job["updated_at"]));
                $new_job->setCategory($old_job["category"]);
                $new_job->setExperience($old_job["experience"]);
                $new_job->setStart(\DateTime::createFromFormat ("Y-m-d", $old_job["start"]));
                $new_job->setEnd(\DateTime::createFromFormat ("Y-m-d", $old_job["end"]));
                $new_job->setDiplomas($old_job["diplomas"]);
                $new_job->setAgeofchildren($old_job["ageofchildren"]);
                $new_job->setLanguages($old_job["languages"]);
                $new_job->setPetitsplus($old_job["petitsplus"]);
                $new_job->setExtraTasks($old_job["extraTasks"]);
                $new_job->setParticularite($old_job["particularite"]);
                $new_job->setPhone($old_job["phone"]);

                $em->persist($new_job);
            }
        }

        $em->flush();
    }

    public function getOrder()
    {
        return 8; // the order in which fixtures will be loaded
    }
}