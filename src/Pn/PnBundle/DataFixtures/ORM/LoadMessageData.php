<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:36
 */

// src/Pn/PnBundle/DataFixtures/ORM/LoadMessageData.php
namespace Pn\PnBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Pn\PnBundle\Entity\Message;

class LoadMessageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        /*$message1 = new Message();
        $message1->setBody('Bonjour ca va bien');
        $message1->setSender($em->merge($this->getReference('user-anna')));
        $message1->setReceiver($em->merge($this->getReference('user-romain')));
        $message1->setIsRead(true);

        $message2 = new Message();
        $message2->setBody('Non.');
        $message2->setSender($em->merge($this->getReference('user-romain')));
        $message2->setReceiver($em->merge($this->getReference('user-anna')));
        $message2->setIsRead(true);

        $message3 = new Message();
        $message3->setBody('Sarah est une de mes amies. Nous avons travaillé ensemble dans un centre de loisir l\'année
        derniere. Elle s\'occupait des activités artisitiques. Les enfants étaient tres réceptifs à ses conseils et elle
        n\'a jamais eu besoin de gronder qui que ce soit. Nous étions tres impressionnés.');
        $message3->setSender($em->merge($this->getReference('user-anna')));
        $message3->setReceiver($em->merge($this->getReference('user-romain')));
        $message3->setIsRead(true);

        $message4 = new Message();
        $message4->setBody('Sarah est une fille tres gentille et tres agréable. Les enfants l\'adorent et nous aussi.');
        $message4->setSender($em->merge($this->getReference('user-romain')));
        $message4->setReceiver($em->merge($this->getReference('user-anna')));
        $message4->setIsRead(true);

        $message5 = new Message();
        $message5->setBody('Salut');
        $message5->setSender($em->merge($this->getReference('user-romain')));
        $message5->setReceiver($em->merge($this->getReference('user-manue')));
        $message5->setIsRead(true);

        $message6 = new Message();
        $message6->setBody('Ca va ?');
        $message6->setSender($em->merge($this->getReference('user-manue')));
        $message6->setReceiver($em->merge($this->getReference('user-romain')));
        $message6->setIsRead(true);



        $em->persist($message1);
        $em->persist($message2);
        $em->persist($message3);
        $em->persist($message4);
        $em->persist($message5);
        $em->persist($message6);*/


        $messages = array(
            array('id' => '1','sender_id' => '261','receiver_id' => '202','status' => NULL,'is_read' => '0','body' => 'Добрый день, Меня очень заинтересовало Ваше предложение, и я хотела бы прислать Вам свои данные/резюме на рассмотрение. Мой электронный адрес anna_medvedenko@mail.ru- будьте добры, сообщить мне свой, чтобы я могла связаться с Вами для обсуждения деталей. Спасибо! С уважением, Анна','created_at' => '2014-06-09 14:35:50'),
            array('id' => '2','sender_id' => '264','receiver_id' => '202','status' => NULL,'is_read' => '0','body' => 'Здравствуйте, меня зовут Кристина, мне 20 лет, я из Украины)  студентка в университете иностранных языков, изучаю английскую и французскую филологию) паралельно работаю репетитором английского для деток младших классов, подрабатывала няней, есть младшая сестра. Очень интересна ваша вакансия, так как на следующий год взяла академ отпуск и хотела поработать и совершенствовать французский язык! Сейчас, как раз, получаю водительские права! Очень жду ваш ответ!!!)','created_at' => '2014-06-10 19:08:43'),
            array('id' => '3','sender_id' => '274','receiver_id' => '202','status' => NULL,'is_read' => '0','body' => 'Здравствуйте, Анна!
Пишу Вам, чтобы предложить на рассмотрение свою кандидатуру.
Меня зовут Женя. Я живу в Казахстане. Мне 24 года.
Русская по национальности, владею грамотным русским языком, также имею уровень C1 во французском и Advanced в английском.
С детьми очень легко нахожу общий язык. Большой опыт в работе в сфере дизайна, можем с детьми делать разные штучки своими руками, рисовать. Люблю спорт, природу, активное времяпрепровождение, обладая при этом терпением и усидчивостью, если нужно позаниматься с детьми. Обладаю неплохими познаниями в социальной психологии и, думаю, с детьми легко найдем общий язык и разносторонние развлечения. Есть водительские права. В дополнение хочу отметить аккуратность, спокойный характер, жизнерадостность.
Приготовлением к отъезду, оформлением визы могу заняться сразу же.
Если у Вас возникнут вопросы-с радостью отвечу.
С уважением, Женя Туркова.','created_at' => '2014-06-13 12:00:00'),
            array('id' => '4','sender_id' => '274','receiver_id' => '202','status' => NULL,'is_read' => '0','body' => 'P.S.: мои координаты: zhenya.turkova@yahoo.fr, tel.: +7-701-793-31-93','created_at' => '2014-06-13 12:06:22'),
            array('id' => '5','sender_id' => '276','receiver_id' => '202','status' => NULL,'is_read' => '0','body' => 'Приветствую Вас! Очень интересно Ваше объявление! Буду рада, если рассмотрите мою кандидатуру. Мне 24 года, с самого студенчества работала в детских лагерях и учреждениях- воспитателем,няней, вожатой и аниматором ( более 3 лет). Проживала в иностраной семье пол года. В семье с тремя детишками. Основные обязаности- полный уход, кормление, досуг ребенка. Языки: русский, испанский(начальный) и английский. Более подробную информацию готова предоставить в личных сообщениях. Надеюсь на дальнейшее сотрудничество. Заранее спасибо! anastasiya_sa@ukr.net Всего наилучшего! С уважением, Анастасия!','created_at' => '2014-06-16 11:51:29'),
            array('id' => '6','sender_id' => '202','receiver_id' => '264','status' => NULL,'is_read' => '0','body' => 'Здравствуйте Кристина, очень интересный у вас профиль. Извините что не сразу ответила. У меня есть несколько вопросов:
- Напишите побольше о себе, чем занимаетесь, где живете на Украине. Пошлите пожалуйста ваше резюме и фотографию.
- Как вы бы провели с детьми 6-ти и 2-ух лет день? Опишите.
- Как я писала в объявлении, мы ищем au pair, это значит, что нам надо не на полное время. Днем дети в школе и яслях большую часть времени (до 18ч). Чем бы вы занимались в это время?
- Мы предоставляем проживание и питание. Но учитывая особенность занятости au pair, мы оплачиваем только карманные расходы (около 250 евро в месяц). Устраивает ли вас такая ситуация?
- Мы живем в деревне (даже можно сказать на хуторе). Вокруг заповедник, но до ближайшего магазина надо ехать на машине. Как вы относитесь к жизни в сельской местности?
Буду рада получить от вас ответ. Пишите мне на личный эл. адрес: stepanoff.anna@gmail.com','created_at' => '2014-06-21 00:02:01'),
            array('id' => '7','sender_id' => '202','receiver_id' => '274','status' => NULL,'is_read' => '0','body' => 'Здравствуйте Женя, спасибо за ваше сообщение. Извините что не сразу ответила. У меня есть несколько вопросов: - Напишите побольше о себе, чем занимаетесь, где живете в Казахстане. Пошлите пожалуйста ваше резюме и фотографию. - Как вы бы провели с детьми 6-ти и 2-ух лет день? Опишите. - Как я писала в объявлении, мы ищем au pair, это значит, что нам надо не на полное время. Днем дети в школе и яслях большую часть времени (до 18ч). Чем бы вы занимались в это время? - Мы предоставляем проживание и питание. Но учитывая особенность занятости au pair, мы оплачиваем только карманные расходы (около 250 евро в месяц). Устраивает ли вас такая ситуация? - Мы живем в деревне (даже можно сказать на хуторе). Вокруг заповедник, но до ближайшего магазина надо ехать на машине. Как вы относитесь к жизни в сельской местности? Буду рада получить от вас ответ. Пишите мне на личный эл. адрес: stepanoff.anna@gmail.com','created_at' => '2014-06-21 00:05:06'),
            array('id' => '8','sender_id' => '309','receiver_id' => '202','status' => NULL,'is_read' => '0','body' => 'Здравствуйте! Меня зовут Аня, мне 25 лет. Имею высшее образование. Занимаюсь преподавательской деятельностью в танцевальном направлении в течении 8 лет среди детей и взрослых. Опыт общения и ухода за детками есть, легко нахожу с ними общий язык. Люблю творчество ( занимаюсь рисованием, hand made). Водительские права есть. Проживала и работала в Дании 1, 5 г. Веду здоровый и активный образ жизни. Моя почта: vanillasky2007@mail.ru Буду ждать ваш ответ!
С уважением, Анна','created_at' => '2014-06-27 15:39:03')
        );

        foreach ($messages as $old_message)
        {
            $new_message = new Message();
            $new_message->setSender($em->merge($this->getReference('user-'.$old_message["sender_id"])));
            $new_message->setReceiver($em->merge($this->getReference('user-'.$old_message["receiver_id"])));
            $new_message->setStatus($old_message["status"]);
            $new_message->setIsRead($old_message["is_read"]);
            $new_message->setBody($old_message["body"]);
            $new_message->setCreatedAt(\DateTime::createFromFormat ("Y-m-d H:i:s", $old_message["created_at"]));
            $em->persist($new_message);
        }

        $em->flush();
    }

    public function getOrder()
    {
        return 10; // the order in which fixtures will be loaded
    }
}