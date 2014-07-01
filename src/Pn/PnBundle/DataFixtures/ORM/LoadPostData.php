<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/03/14
 * Time: 15:36
 */

// src/Pn/BlogBundle/DataFixtures/ORM/LoadPostData.php
namespace Pn\BlogBundle\DataFixtures\ORM;

use Application\Sonata\NewsBundle\Entity\Post;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Sonata\NewsBundle\Model\CommentInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadPostData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $em)
    {
        $postManager = $this->getPostManager();

        // Article 1
        $post1 = $postManager->create();
        $post1->setAuthor($this->getReference('user-anna'));
        $post1->setAbstract('Les comptines représentent une source majeure d\'apprentissage
        linguistique et culturel des tout-petits. Elles permettent à l\'enfant d\'incorporer...');
        $post1->setTitle('Du geste à la parole');
        //$post1->setCategory($em->merge($this->getReference('cat-prevention')));
        $post1->setRawContent('Les comptines représentent une source majeure d\'apprentissage
        linguistique et culturel des tout-petits. Elles permettent à l\'enfant d\'incorporer');
        $post1->setEnabled(true);
        $post1->setContentFormatter('markdown');
        $post1->setContent($this->getPoolFormatter()->transform($post1->getContentFormatter(), $post1->getRawContent()));
        $post1->setCommentsDefaultStatus(CommentInterface::STATUS_VALID);
        $post1->setCollection($this->getReference('collection-alaune'));
        $post1->setOnHomePage(true);
        $postManager->save($post1);

        // Article 2
        $post2 = $postManager->create();
        $post2->setAuthor($this->getReference('user-anna'));
        $post2->setAbstract('Pour une femme, mener de front vie familiale et vie professionnelle est devenu tout à fait faisable. Les...');
        $post2->setTitle('Concilier vie familiale et vie professionnelle');
        //$post1->setCategory($em->merge($this->getReference('cat-prevention')));
        $post2->setRawContent('Pour une femme, mener de front vie familiale et vie professionnelle est devenu tout à fait faisable. Les femmes françaises sont connues pour leur taux de fécondité particulièrement élevé en Europe – deux enfants par femme en moyenne, – et leur dévouement au travail – plus de 80% de mères de 25 à 49 ans sont actives. Près de 5,5 millions de femmes en France, coûte que coûte, semble-t-il réussissent leur conciliation.

Concilier sonne doux, limpide, simple... Pourtant, la plupart de ces femmes en réalité vivent non pas une conciliation, mais une bataille au quotidien. Entre les obligations du travail, avec ses réunions et ses projets interminables d’un côté, et l’enfant avec ses rythmes et ses besoins de l’autre, la femme, elle, son corps et son temps deviennent le terrain sur lequel s’affrontent au jour le jour vie familiale et vie professionnelle. Peut-on gagner un tel combat sans piétiner le terrain ? Peut-on retrouver une coexistence paisible?.

Les femmes sont intelligentes, elles ont développés de nombreuses techniques qui leur assurent une survie au milieu d’une bataille. Elles sont devenues diplomates dans la course à la place en crèche en maniant avec finesse l’art de composition des formulaires et de siège des instances publiques. Elles sont devenues détectives pour la recherche de la nounou idéale grâce aux indices récoltés dans des annonces, lors des coups de fils et des entretiens. Elles sont devenues commandos, les matins et les soirs, pour les interminables habillages, repas, déshabillages, bain, couchages. Elles sont devenues résistantes contre les petits assaillants en proie à une sucrerie ou un jouet à la mode. Elles sont devenues stratèges en vue des vacances pour jongler entre les différents modes de garde. Elles ont bien évidemment aussi toujours été ... des éducatrices qui ne cessent de transmettre des valeurs, des savoir-faire et des savoir-vivre dans l’espoir de voir un jour leurs enfants réussir..

Rien n’est gagné à aucun moment. Pour ménager la tension permanente de combat, les mamans qui travaillent développent souvent un certain détachement par rapport à leur rôle de parent. Ce détachement permet d’ironiser quand une autre aurait envie de pleurer, de se préparer à accepter quoi qu’il arrive, de se déculpabiliser. Tout un discours s’est construit autour d’une « mère indigne » qui aide les mamans à s’approprier les techniques de détachement et de réduire le stress. On devient ainsi une mère peut-être un peu moins bonne, mais une mère tout de même, qui travaille et qui réussit d’une certaine manière de s’épanouir..

Au-delà des techniques de survie qui s’apprennent « naturellement » et d’une attitude de détachement sûrement salutaire, mais toujours un peu regrettable, il y a encore tout un arsenal d’outils et de pratiques à inventer pour réduire les dégâts de l’affrontement et pour apporter la meilleure éducation possible aux enfants qui se retrouvent parfois prisonniers d’un combat dont ils ignorent l’existence. Nous avons créé ce site pour aider les 5,5 millions de mères qui travaillent (et les pères aussi), à mieux concilier vie familiale et vie professionnelle en retrouvant un peu de bonheur et de sérénité.

Puisque souvent le salut passe par une garde de qualité, notre premier objectif consiste à faciliter la mise en relation des parents et des nounous. Un moteur de recherche intelligent basé sur un système de points de confiance permettra aux parents de trouver rapidement une nounou en fonction de leurs critères particuliers. Les nounous, quant à elles, peuvent s’inscrire gratuitement etse créer une belle page afin de mettre en valeur leurs atouts et attirer efficacement les familles intéressées. Notre site se veut un intermédiaire virtuel personnalisé au service des parents et des nounous disponible 24h/24h, 7j/7j.

En plus d’être intermédiaire, ce site est, par ailleurs, se dotera progressivement d’un espace de formation virtuelle. Dans cet espace, en partenariat avec des experts, nous publierons régulièrement des articles et des vidéos. Nous accompagnerons ainsi les parents et les nounous dans leur rôle d’éducateur et chercherons à faciliter leur quotidien sur des sujets aussi sensibles que le repas, le sommeil, les soins corporels, la santé, la propreté et les démarches administratives. Nous souhaitons que cet échange soit interactif : nous mettons en place un forum et invitons les parents et les professionnels à participer à la discussion et à partager leurs meilleures pratiques.

Quels sujets souhaiterez-vous que nous abordions dans nos publications ? Partagez vos idées !


Par Anna Stépanoff');
        $post2->setEnabled(true);
        $post2->setContentFormatter('markdown');
        $post2->setContent($this->getPoolFormatter()->transform($post2->getContentFormatter(), $post2->getRawContent()));
        $post2->setCommentsDefaultStatus(CommentInterface::STATUS_VALID);
        $post2->setCollection($this->getReference('collection-alaune'));
        $post2->setOnHomePage(true);
        $postManager->save($post2);

    }

    public function getOrder()
    {
        return 5; // the order in which fixtures will be loaded
    }

    public function getPoolFormatter()
    {
        return $this->container->get('sonata.formatter.pool');
    }

    /**
     * @return \Sonata\NewsBundle\Model\PostManagerInterface
     */
    public function getPostManager()
    {
        return $this->container->get('sonata.news.manager.post');
    }
}