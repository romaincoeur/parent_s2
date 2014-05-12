<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:36
 */

// src/Pn/PnBundle/DataFixtures/ORM/LoadBabysitterData.php
namespace Pn\PnBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Pn\PnBundle\Entity\Babysitter;

class LoadBabysitterData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $babysitter_romain = new Babysitter();
        $babysitter_romain->setUser($em->merge($this->getReference('user-romain')));
        $babysitter_romain->setCategory('assistante');
        $babysitter_romain->addAgeOfChildren("3");
        $babysitter_romain->addAgeOfChildren("4");
        $babysitter_romain->setCalendar("[(0000010)(0000010)(0000010)(0000010)(0000010)(1000000)(1000000)(1000000)(0100000)
        (0100000)(0100000)(0000000)(0000000)(0010000)(0010000)(0010000)(0000000)(0000000)(0001000)(0001000)(0001000)(0000100)(0000100)(0000100)]");
        $babysitter_romain->addLanguage('fr');
        $babysitter_romain->addLanguage('en');
        $babysitter_romain->addParticularite('permis');
        $babysitter_romain->addExtraTask('cleaning');

        $babysitter_sarah = new Babysitter();
        $babysitter_sarah->setUser($em->merge($this->getReference('user-sarah')));
        $babysitter_sarah->setRatePrice(10);
        $babysitter_sarah->setRateType('hour');
        $babysitter_sarah->setPresentation("Je m'appelle Clémentine, j'ai 28 ans, je suis animatrice pour enfants et
comédienne. J'ai mon BAFA, et j'ai été cheftaine scout et animatrice de centre de loisir pendant plusieurs années. A
présent, je propose des animations de goûter d'anniversaire : je maquille les enfants puis j'organise des jeux sur un
thème de conte de fée, afin de préparer les enfants au spectacle de marionnettes qui va suivre. Vous pourrez choisir des
contes célèbres comme Pinocchio, le Petit Chaperon rouge, et aussi des contes plus rares du folklore Russe avec les
histoires de la sorcière Babayaga ou de la princesse Vassilissa... Pour les tout petits je présenterai aussi des
comptines et fables plus courtes avec des marionnettes en forme d'animaux. Je propose également des spectacles d'ombre
chinoises...<br>
Enfin, je jouerai à partir du 8 janvier dans un joli spectacle théâtral et musical pour enfant à la Comédie de la
Passerelle : La Sorcière Polluair et le petit peuple vert !");
        $babysitter_sarah->setCategory('nounou');
        $babysitter_sarah->addAgeOfChildren("1");
        $babysitter_sarah->addAgeOfChildren("2");
        $babysitter_sarah->setExperience(16);
        $babysitter_sarah->addLanguage('fr');
        $babysitter_sarah->addExtraTask('cooking');
        $babysitter_sarah->addPetitsPlus('bio');

        $babysitter_manue = new Babysitter();
        $babysitter_manue->setUser($em->merge($this->getReference('user-manue')));
        $babysitter_manue->setCategory('babysitter');
        $babysitter_manue->setExperience(4);
        $babysitter_manue->addAgeOfChildren("0");
        $babysitter_manue->addAgeOfChildren("1");
        $babysitter_manue->addLanguage('fr');
        $babysitter_manue->addLanguage('es');
        $babysitter_manue->addExtraTask('ironing');

        $babysitter_julie = new Babysitter();
        $babysitter_julie->setUser($em->merge($this->getReference('user-julie')));
        $babysitter_julie->setCategory('aupair');
        $babysitter_julie->setExperience(3);
        $babysitter_julie->addLanguage('fr');
        $babysitter_julie->addLanguage('ru');

        $em->persist($babysitter_romain);
        $em->persist($babysitter_sarah);
        $em->persist($babysitter_manue);
        $em->persist($babysitter_julie);


        for ($i=1;$i<=10;$i++)
        {
            $babysitter_test = new Babysitter();
            $babysitter_test->setUser($em->merge($this->getReference('user-test'.$i)));
            $babysitter_test->setCategory('assistante');
            $babysitter_test->setTrustpoints(abs((mt_rand() / mt_getrandmax())*5000));
            $babysitter_test->addLanguage('fr');

            $em->persist($babysitter_test);
        }


        $em->flush();
    }

    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }
}