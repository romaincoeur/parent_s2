<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:36
 */

// src/Pn/PnBundle/DataFixtures/ORM/LoadRecommendationData.php
namespace Pn\PnBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Pn\PnBundle\Entity\Recommendation;

class LoadRecommendationData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        /*$recommendation1 = new Recommendation();
        $recommendation1->setBody('Sarah est une de mes amies. Nous avons travaillé ensemble dans un centre de loisir
        l\'année derniere. Elle s\'occupait des activités artisitiques. Les enfants étaient tres réceptifs à ses
        conseils et elle n\'a jamais eu besoin de gronder qui que ce soit. Nous étions tres impressionnés.');
        $recommendation1->setGiver($em->merge($this->getReference('user-romain')));
        $recommendation1->setReceiver($em->merge($this->getReference('user-sarah')));

        $recommendation2 = new Recommendation();
        $recommendation2->setBody('Sarah est une fille tres gentille et tres agréable. Les enfants l\'adorent et nous aussi.');
        $recommendation2->setGiver($em->merge($this->getReference('user-anna')));
        $recommendation2->setReceiver($em->merge($this->getReference('user-sarah')));

        $em->persist($recommendation1);
        $em->persist($recommendation2);*/


        $recommendations = array(
            array('id' => '1','giver_id' => '261','receiver_id' => '202','status' => NULL,'body' => 'Добрый день,

Меня очень заинтересовало Ваше предложение, и я хотела бы прислать Вам свои данные/резюме на рассмотрение. Мой электронный адрес anna_medvedenko@mail.ru- будьте добры, сообщить мне свой, чтобы я могла связаться с Вами для обсуждения деталей. Спасибо!  С уважением, Анна','created_at' => '2014-06-09 14:06:49'),
            array('id' => '2','giver_id' => '263','receiver_id' => '202','status' => NULL,'body' => NULL,'created_at' => '2014-06-10 06:52:50'),
            array('id' => '3','giver_id' => '263','receiver_id' => '202','status' => NULL,'body' => 'Добрый день! Меня зовут Надя, я к сожалению не подхожу по возрасту, мне уже 40 лет, активная энергичная, люблю спрорт стараюсь вести активный образ жизни. Мне бы очень хотелось помочь вам с детками. Я знакома с этой программой, работала 2 года в немецкой семье. Сейчас я живу во Франции, есть права, знаю немножко французкий и хочу его совершенствовать, есть все необходимые документы для проживания. Без семейных проблем. Если вас заинтересовали мои данные, напишите, буду очень рада продолжить знакомство.Мой электронный адрес marusya_28@rambler.ru Спасибо.С уважением Надя.','created_at' => '2014-06-10 07:02:39'),
            array('id' => '4','giver_id' => '269','receiver_id' => '202','status' => NULL,'body' => 'Добрый день, меня зовут Салия и меня тоже очень заинтересовало ваше предложение) мне 29 лет мой e`mail: moon_sally@mail.ru) я дипломированный педагог, если вам интересно то буду рада вам помочь))','created_at' => '2014-06-11 08:51:45'),
            array('id' => '5','giver_id' => '270','receiver_id' => '202','status' => NULL,'body' => 'Здравствуйте, Меня заинтересовало Ваше предложение о работе, хотелось бы Вам все подробно написать на почту. Мой имейл baziliskina@gmail.com. Кратко о  мне. Я студенка, 20 лет, активная жизненная позиция, моя мечта жить и работать во Франции. Права водительские имеются, свободно говорю на русском и английском, опыт работы с детьми имеется. Более подробней сообщу Вам письме.

С Уважением, Вероника.','created_at' => '2014-06-11 16:59:38'),
            array('id' => '6','giver_id' => '271','receiver_id' => '202','status' => NULL,'body' => 'Здравствуйте. Очень заинтересовало ваше объявление, хочу предложить вам свою кандидатуру. Мне 23 года, высшее педагогическое образование, опыт занятий с детьми. Языки: русский (родной), французский (свободный), английский (разговорный). В данный  момент проживаю в Люксембурге и хотелось бы найти работу с августа или сентября во франкоязычной стране. Мой e-mail: rin_1901@mail.ru Обращайтесь в любое время, буду рада. С уважением, Ирина.','created_at' => '2014-06-11 22:15:01'),
            array('id' => '7','giver_id' => '275','receiver_id' => '202','status' => NULL,'body' => 'Здравствуйте, меня заинтересовало это объявление! если вам не трудно, посмотрите мой профиль

http://www.parent-nounou.fr/babysitter/45/edit','created_at' => '2014-06-15 13:24:32'),
            array('id' => '8','giver_id' => '276','receiver_id' => '202','status' => NULL,'body' => 'Приветствую Вас! Очень интересно Ваше объявление! Буду рада, если рассмотрите мою кандидатуру. Мне 24 года, с самого студенчества работала в детских лагерях и учреждениях- воспитателем,няней, вожатой и аниматором ( более 3 лет). Проживала в иностраной семье пол года. В семье с тремя детишками. Основные обязаности- полный уход, кормление, досуг ребенка. Языки: русский, испанский(начальный) и английский. Более подробную информацию готова предоставить в личных сообщениях. Надеюсь на дальнейшее сотрудничество. Заранее спасибо! anastasiya_sa@ukr.net
Всего наилучшего! С уважением, Анастасия!','created_at' => '2014-06-16 11:50:00'),
            array('id' => '9','giver_id' => '278','receiver_id' => '202','status' => NULL,'body' => 'Здравствуйте. Очень заинтересовало ваше объявление, хочу предложить вам свою кандидатуру. Мне 23 года, опыт занятий с детьми. Права водительские имеются Языки: русский (родной), французский , английский  итальянский шведский. В данный момент проживаю в Швеции и хотелось бы найти работу с августа или сентября во Франции. Мой e-mail: blumarine1@yandex.ru Обращайтесь в любое время, буду рада. С уважением, Marina','created_at' => '2014-06-16 17:03:21'),
            array('id' => '10','giver_id' => '3','receiver_id' => '281','status' => NULL,'body' => 'I likes','created_at' => '2014-06-17 19:55:43'),
            array('id' => '11','giver_id' => '3','receiver_id' => '281','status' => NULL,'body' => 'Superbe nounou','created_at' => '2014-06-17 19:56:02'),
            array('id' => '12','giver_id' => '283','receiver_id' => '202','status' => NULL,'body' => 'Здравствуйте! Меня зовут Светлана, мне 29 лет. Готова принять Ваше предложение, если Вам подойду. Имею два высших образования, родной язык русский, интересуюсь живописью, этим мне и интересна Франция, в свободное время намерена изучать язык. Опыт общения с детьми есть. Детям со мной интересно. Ваши дети уже не совсем маленькие, этот возраст самый интересный и важный для закладывания и развития их направления. Смогу увидеть и раскрыть способности ребенка, привить чувство к прекрасному, хотя, думаю последнего не понадобится, ведь дети все помнят, в отличии от взрослых, которые выросли и забыли) Мой e-mail: jilenkovas@mail.ru буду рада Вашему письму!','created_at' => '2014-06-20 11:57:19'),
            array('id' => '13','giver_id' => '202','receiver_id' => '3','status' => NULL,'body' => 'Clémentine est une excellente animatrice. Les enfants l\'ont adoré. Mon fils parle toujours de la "fée magique descendue du ciel"...','created_at' => '2014-06-20 21:43:11'),
            array('id' => '14','giver_id' => '295','receiver_id' => '202','status' => NULL,'body' => 'Здравствуйте!  Очень заинтересовалась вашей вакансией. Коротко о себе: закончила медицинский колледж, прошла стажировку по сестринскому делу в педиатрии в психо-неврологической больнице как массажист. Опыт работы медсестрой массажистом 2 года. Отлично лажу с детьми. Люблю заниматься рукоделием, декураж, handmade, и др, развивающими мелкую маторику вещами. Люблю гулять на свежем воздухе, кататься на велосипеде и конечно де люблю Францию! Училась в языковой школе LSF в городе Montpellier. Также имею открытую визу с пребыванием до 15.11.14 так что готова приступить как можно быстрее. Более подробное резюме могу выслать на почту. (radzyuk.alena@mail.ru)','created_at' => '2014-06-24 23:43:24'),
            array('id' => '15','giver_id' => '309','receiver_id' => '202','status' => NULL,'body' => 'Здравствуйте! Меня зовут Аня, мне 25 лет. Имею высшее образование. Занимаюсь преподавательской деятельностью в танцевальном направлении в течении 8 лет среди детей и взрослых. Опыт общения и ухода за детками есть, легко нахожу с ними общий язык. Люблю творчество ( занимаюсь рисованием, hand made). Водительские права есть. Проживала и работала в Дании 1, 5 г. Веду здоровый и активный образ жизни. Моя почта: vanillasky2007@mail.ru Буду ждать ваш ответ! С уважением, Анна','created_at' => '2014-06-27 22:34:28'),
            array('id' => '16','giver_id' => '3','receiver_id' => '316','status' => NULL,'body' => '1 place DISPONIBLE','created_at' => '2014-06-28 12:49:19')
        );

        foreach ($recommendations as $old_recommendation)
        {
            $new_recommendation = new Recommendation();
            $new_recommendation->setGiver($em->merge($this->getReference('user-'.$old_recommendation["giver_id"])));
            $new_recommendation->setReceiver($em->merge($this->getReference('user-'.$old_recommendation["receiver_id"])));
            $new_recommendation->setStatus($old_recommendation["status"]);
            $new_recommendation->setBody($old_recommendation["body"]);
            $new_recommendation->setCreatedAt(\DateTime::createFromFormat ("Y-m-d H:i:s", $old_recommendation["created_at"]));
            $em->persist($new_recommendation);
        }

        $em->flush();
    }

    public function getOrder()
    {
        return 11; // the order in which fixtures will be loaded
    }
}