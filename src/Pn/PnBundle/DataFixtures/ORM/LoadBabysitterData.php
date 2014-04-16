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

        $babysitter_sarah = new Babysitter();
        $babysitter_sarah->setUser($em->merge($this->getReference('user-sarah')));
        $babysitter_sarah->setRatePrice(10);
        $babysitter_sarah->setRateType('heure');
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

        $babysitter_manue = new Babysitter();
        $babysitter_manue->setUser($em->merge($this->getReference('user-manue')));
        $babysitter_manue->setCategory('babysitter');

        $babysitter_julie = new Babysitter();
        $babysitter_julie->setUser($em->merge($this->getReference('user-julie')));
        $babysitter_julie->setCategory('aupair');

        $em->persist($babysitter_romain);
        $em->persist($babysitter_sarah);
        $em->persist($babysitter_manue);
        $em->persist($babysitter_julie);

        $em->flush();
    }

    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }
}