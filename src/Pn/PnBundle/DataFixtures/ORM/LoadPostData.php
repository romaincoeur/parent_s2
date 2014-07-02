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

        /*// Article 1
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
        $postManager->save($post2);*/

        $blog_articles = array(
            array('id' => '1','blog_category_id' => '266','title' => 'Concilier vie familiale et vie professionnelle','presentation' => '<p>Pour une femme, mener de front vie familiale et vie professionnelle est devenu tout à fait faisable.
Les femmes françaises sont connues pour leur taux de fécondité particulièrement élevé en Europe –
deux enfants par femme en moyenne, – et leur dévouement au travail – plus de 80% de mères de 25
à 49 ans sont actives. Près de 5,5 millions de femmes en France, coûte que coûte, semble-t-il
réussissent leur conciliation.</p>
<p>Concilier sonne doux, limpide, simple... Pourtant, la plupart de ces femmes en réalité vivent non pas
une conciliation, mais une bataille au quotidien. Entre les obligations du travail, avec ses réunions et
ses projets interminables d’un côté, et l’enfant avec ses rythmes et ses besoins de l’autre, la femme,
elle, son corps et son temps deviennent le terrain sur lequel s’affrontent au jour le jour vie familiale
et vie professionnelle. Peut-on gagner un tel combat sans piétiner le terrain ? Peut-on retrouver une
coexistence paisible?.</p>
<p>Les femmes sont intelligentes, elles ont développés de nombreuses techniques qui leur assurent une
survie au milieu d’une bataille. Elles sont devenues diplomates dans la course à la place en crèche en
maniant avec finesse l’art de composition des formulaires et de siège des instances publiques. Elles
sont devenues détectives pour la recherche de la nounou idéale grâce aux indices récoltés dans des
annonces, lors des coups de fils et des entretiens. Elles sont devenues commandos, les matins et les
soirs, pour les interminables habillages, repas, déshabillages, bain, couchages. Elles sont devenues
résistantes contre les petits assaillants en proie à une sucrerie ou un jouet à la mode. Elles sont
devenues stratèges en vue des vacances pour jongler entre les différents modes de garde. Elles ont
bien évidemment aussi toujours été ... des éducatrices qui ne cessent de transmettre des valeurs, des
savoir-faire et des savoir-vivre dans l’espoir de voir un jour leurs enfants réussir..</p>
<p>Rien n’est gagné à aucun moment. Pour ménager la tension permanente de combat, les mamans qui
travaillent développent souvent un certain détachement par rapport à leur rôle de parent. Ce
détachement permet d’ironiser quand une autre aurait envie de pleurer, de se préparer à accepter
quoi qu’il arrive, de se déculpabiliser. Tout un discours s’est construit autour d’une « mère indigne »
qui aide les mamans à s’approprier les techniques de détachement et de réduire le stress. On devient
ainsi une mère peut-être un peu moins bonne, mais une mère tout de même, qui travaille et qui
réussit d’une certaine manière de s’épanouir..</p>
<p>Au-delà des techniques de survie qui s’apprennent « naturellement » et d’une attitude de
détachement sûrement salutaire, mais toujours un peu regrettable, il y a encore tout un arsenal
d’outils et de pratiques à inventer pour réduire les dégâts de l’affrontement et pour apporter la
meilleure éducation possible aux enfants qui se retrouvent parfois prisonniers d’un combat dont ils
ignorent l’existence. Nous avons créé ce site pour aider les 5,5 millions de mères qui travaillent (et
les pères aussi), à mieux concilier vie familiale et vie professionnelle en retrouvant un peu de
bonheur et de sérénité.</p>
<p>Puisque souvent le salut passe par une garde de qualité, notre premier objectif consiste à faciliter la
mise en relation des parents et des nounous. Un moteur de recherche intelligent basé sur un
système de points de confiance permettra aux parents de trouver rapidement une nounou en
fonction de leurs critères particuliers. Les nounous, quant à elles, peuvent s’inscrire gratuitement etse créer une belle page afin de mettre en valeur leurs atouts et attirer efficacement les familles
intéressées. Notre site se veut un intermédiaire virtuel personnalisé au service des parents et des
nounous disponible 24h/24h, 7j/7j.</p>
<p>En plus d’être intermédiaire, ce site est, par ailleurs, se dotera progressivement d’un espace de
formation virtuelle. Dans cet espace, en partenariat avec des experts, nous publierons régulièrement
des articles et des vidéos. Nous accompagnerons ainsi les parents et les nounous dans leur rôle
d’éducateur et chercherons à faciliter leur quotidien sur des sujets aussi sensibles que le repas, le
sommeil, les soins corporels, la santé, la propreté et les démarches administratives. Nous souhaitons
que cet échange soit interactif : nous mettons en place un forum et invitons les parents et les
professionnels à participer à la discussion et à partager leurs meilleures pratiques.</p>
<p>Quels sujets souhaiterez-vous que nous abordions dans nos publications ? Partagez vos idées !</p>

<br>
<p><i>Par Anna Stépanoff</i></p>','is_activated' => '1','created_at' => '2014-05-20 16:13:40','updated_at' => '2014-05-20 21:23:06','miniPresentation' => 'Pour une femme, mener de front vie familiale et vie professionnelle est devenu tout à fait faisable.
Les ...','onWelcomePage' => '1'),
            array('id' => '2','blog_category_id' => '270','title' => 'Quel mode de garde choisir ?','presentation' => '<p>Il existe quatre modes de garde principaux pour un enfant de moins de 3 ans : les parents (la
mère dans 90% des cas), l’assistante maternelle agrée, la crèche et la nourrice à domicile. Des
solutions intermédiaires voient le jour régulièrement – la micro-crèche, le jardin d’éveil, la halte-
garderie, la crèche parentale, la maison des assistantes maternelle, la garde partagée. Nous n’en
parlerons pas ici, car le plus souvent elles ne sont qu’un prolongement, une variation ou une
combinaison des quatre principaux modes de garde.</p>
<p>Avant de choisir son mode de garde, il convient d’établir les critères pertinents et les prioriser. Sur la
base d’entretiens avec des parents, nous avons défini ici les quatre critères qui semblent prévaloir :
<ul>
<li>Richesse et qualité pédagogique (activités proposées, qualification du personnel, ...)</li>
<li>Sécurité, santé et confiance qu’inspire le mode de garde</li>
<li>Facilité (proximité au domicile, horaires, ...)</li>
<li>Coût</li>
</ul>
<p>Examinons maintenant les différents modes de garde à l’aune de ces quatre critères :</p>

<p><b>Richesse et qualité pédagogique</b></p>
<p>Tout dépend ici de la motivation, des compétences et de la disponibilité des personnes qui
s’occupent de l’enfant. On peut observer que la crèche, semble aujourd’hui offrir des opportunités
d’apprentissage supérieures en moyenne aux autres modes de garde. Son projet pédagogique
souvent très élaboré est appliqué au quotidien par des professionnels bien formés. La vie en
collectivité participe elle aussi à l’ouverture de l’enfant aux autres et le prépare de ce fait à l’entrée
en école maternelle.</p>

<p><b>Sécurité, santé et confiance</b></p>
<p><i>Parents :</i> Sérénité 100% garantie, car l’enfant reste auprès des parents en permanence.</p>
<p><i>Assistante maternelle agréé :</i> L’enfant est moins malade qu’à la crèche et dort mieux en général, car
il est au calme. Pourtant, parfois, un manque de transparence sur le déroulement de la journée peut
générer de l’inquiétude auprès des parents.</p>
<p><i>Crèche :</i> Des professionnels de la petite enfance prennent en charge l’enfant en suivant des règles
très strictes de vie en collectivité. La prise en charge de la garde par une institution est rassurante
pour les parents. Néanmoins, l’enfant y est plus souvent malade et son rythme de sommeil peut être
perturbé.</p>
<p><i>Nourrice à domicile :</i> L’enfant reste dans son cadre familial. La nourrice s’adapte généralement à ses
rythmes. Ce mode de garde et donc très rassurant pour les parents. N’étant pas en contact avec d’autres enfants au quotidien, l’enfant évite aussi certaines maladies. Si la nourrice est compétente et expérimentée, ce mode de garde sûr est très favorable à la santé et au bien-être de l’enfant.</p>

<p><b>Facilité</b></p>
<p><i>Parents :</i> Facile quand le choix est assumé, la garde parentale peut devenir très pesante, si le parent y
est contraint par absence de choix et compromet ainsi ses activités professionnelles.</p>
<p><i>Assistante maternelle agrée :</i> Il est en général possible de trouver une assistante maternelle près de
soi. Les horaires aussi peuvent être relativement souples. Mais le fait de devoir fournir parfois des
couches ou autre matériel peut générer un stress occasionnel.</p>
<p><i>Crèche :</i> Ce mode de garde est le plus rigide en termes d’horaires et d’emplacement. On n’a que très
exceptionnellement le choix entre plusieurs crèches. D’un autre côté, lorsque les repas, les couches
et tout le matériel sont fournis par la structure, les parents s’en trouvent déchargés.</p>
<p><i>Nourrice à domicile :</i> C’est la solution la plus simple. Inutile de réveiller l’enfant le matin quand les
parents doivent partir au travail, pas besoin de le chercher le soir non plus. La nourrice confectionne
des petits plats sur place et peut même parfois donner un coup de main pour le ménage, le
repassage et les repas des grands.</p>

<p><b>Coût</b></p>
<p><i>Parents :</i> Ce mode de garde est le moins onéreux, presque gratuit (bon, il y a quand même le coût
des couches et des repas). Néanmoins, le temps consacré à la garde peut impliquer de renoncer à
des opportunités de travail ou à des activités considérées comme plus épanouissantes, de sorte que
son coût peut s’avérer en fin de compte assez élevé pour certains parents...</p>
<p><i>Assistante maternelle agrée :</i> Un petit peu plus cher que la crèche, mais bien moins cher qu’une
nourrice à domicile. Le coût horaire moyen se situe entre 3 et 4 euros. Un supplément journalier de
l’ordre de 3-4 euros pour les repas et autres soins peut être exigé parfois en plus. Pour une garde
standard (9h par jour, semaine complète) et une famille aux revenus moyens, le coût réel en
déduisant l’aide de la Caf représente environ 400 euros mensuels (coût total de 700 euros moins
l’aide de la Caf d’environ 300 euros, sans compter le crédit d’impôt).</p>
<p><i>Crèche :</i> Ici, le tarif est souvent très progressif en fonction des revenus des parents. Le coût réel est
donc beaucoup plus gradué que pour une assistante maternelle. Ainsi, une garde standard (9h par
jour, semaine complète) pour une famille aux revenus moyens représente un coût réel d’environ
200-400 euros mensuels, sans compter le crédit d’impôt (normalement, il n’y a pas d’aide de la Caf
pour la crèche).</p>
<p><i>Nourrice à domicile :</i> C’est le mode de garde le plus onéreux, avec un coût mensuel réel de l’ordre de
1200-1500 euros (après déduction de l’aide de la Caf d’environ 700 euros pour une famille à revenus
moyens et avant le crédit d’impôt). Néanmoins, ce mode de garde peut devenir intéressant enversion garde partagée entre plusieurs familles ou dans le cas de garde de plusieurs enfants d’une
même famille à la fois.</p>
<br>
<p>De cette rapide analyse des avantages et des inconvénients des différents modes de garde, il ressort
qu’aucun mode de garde n’est absolument supérieur aux autres. Chacun peut être intéressant dans
une situation donnée en fonction des exigences et priorités des parents, de leurs moyens financiers
disponibles et des affinités personnelles. Il ressort aussi que la qualité et les compétences de la
personne qui s’occupe de l’enfant priment souvent sur le type de mode de garde choisi.</p>
<p>Pour conclure, voici quelques données statistiques :</p>

<ul>
<li>Près de la moitié des enfants de moins de trois ans sont gardés par leurs parents ;</li>
<li>Un tiers va chez une assistante maternelle agrée ;</li>
<li>Environ 15% fréquentent la crèche ;</li>
<li>Enfin, un petit 2% sont dorlotés par une nourrice à domicile.</li>
</ul>

<p>Cette répartition actuelle par mode de garde ne correspond pas tout à fait aux souhaits des parents,
car moins d’un tiers seulement gardent leurs enfants eux-mêmes par choix délibéré. Quant à la
crèche, un quart des parents souhaiteraient en bénéficier. Ceci nous révèle que le « choix » du mode
de garde est encore souvent un choix contraint. Dans beaucoup trop de cas, les parents recourent à
un mode de garde qui ne correspond pas à leur préférence initiale.</p>
<p>On ne peut que souhaiter que l’offre des différents modes de garde se diversifie et se rapproche aux
souhaits des parents, que le maximum de familles puissent bénéficier d’un vrai choix et ne soient pas
contraintes, en son absence, de se résigner à un mode de garde par défaut.</p>
<br>

<p>Et vous, comment avez-vous procédé dans votre choix de mode de garde ? Avez-vous utilisé d’autres
critères ? Avez-vous eu le choix ?</p>
<br>

<p><i>Par Anna Stépanoff</i></p>','is_activated' => '1','created_at' => '2014-05-20 16:27:20','updated_at' => '2014-05-20 21:24:23','miniPresentation' => 'Il existe quatre modes de garde principaux pour un enfant de moins de 3 ans : les parents (dont la
mère dans 90% des cas), l’assistante ...','onWelcomePage' => '1'),
            array('id' => '3','blog_category_id' => '269','title' => 'Qu’est-ce qu’une bonne nounou ?','presentation' => '<p>Curieusement, je ne crois pas que nous allons avoir un débat sur ce qu’est une bonne nounou. Des
qualités que j’ai rassemblé ici sont issues de nombreux entretiens avec d’autres parents et d’une
lecture assidue des forums où les parents s’expriment. Les avis convergent facilement. Il m’a été aisé
d’en faire un résumé ici.</p>
<br>
<br>

<p><b>Elle aime les enfants</b></p>
<p>J’évoquerai plusieurs qualités, mais tout d’abord parlons des qualités fondamentales indispensables
pour prétendre à s’occuper des enfants. Et en premier, je mettrais l’amour pour les enfants. Oui, la
nounou doit aimer travailler avec les enfants et aimer les enfants tout court. Aussi banal que cela
puisse paraître, il y a des personnes qui se lancent dans ce métier sans avoir de vocation particulière,
par facilité ou par un calcul quelconque. Le meilleur moyen de tester cette qualité est d’observer la
nounou avec d’autres enfants et aussi voir comment elle fait connaissance avec le vôtre. L’amour
pour les enfants, ça ne se décrète pas, ça ne s’apprend pas tout à fait et ça se voit rapidement.</p>
<p><b>Elle est compétente</b></p>
<p>En deuxième position vient la compétence de la nounou, son expérience, les connaissances et les
bons gestes qu’elle a acquis. Parfois on peut chercher une nounou moyennement compétente,
quand notamment elle sera amenée à s’occuper de l’enfant près de vous ou temporairement. Dans
la plupart des cas, quand même, vous allez préférer une nounou avec de l’expérience, qui a de
surcroit suivi quelques formations. Il ne faut jamais hésiter à lui poser des questions là-dessus. Une
bonne nounou aura des réponses toutes prêtes, vous sortira son dossier de lettres de référence et de
diplômes et aura le plaisir de les partager avec vous. Fuyez celle qui, au contraire, semble hésiter et
n’est pas capable de vous citer ne serait-ce que quelques expériences récentes de baby-sitting.</p>

<p><b>Elle est disponible</b></p>
<p>Enfin, une qualité tout aussi essentielle est sa disponibilité. Evoquez dès le départ toutes les périodes
quand vous en aurez besoin. Clarifiez quand la nounou compte prendre ses congés et quelles autres
obligations peuvent la retenir ou l\'empêcher de se consacrer à son travail – la garde de votre
enfant. Comme il arrive toujours des imprévus, demandez comment elle gère habituellement ce
genre de situations. Si son enfant est malade et doit par exemple voir un médecin, comment s\'y
prend-t-elle pour vous prévenir ? Quand et comment fait-elle son propre ménage, ses courses ? Sait-
elle s’organiser pour ne pas pénaliser les enfants qui lui sont confiés ?</p>

<p><b>Le feeling passe</b></p>
<p>Les mamans parlent souvent du « feeling » qui passe ou qui ne passe pas. Ce feeling qui n’est autre
chose que le sentiment d’appartenir à la même communauté d’idées ou de valeurs est certes
important. Je me méfierais tout de même d’une confiance trop aveugle à ce sentiment vague. Se fier
au feeling permet d’éviter des discussions parfois difficiles de l’organisation concrète de la garde,
mais peut laisser tout un pan des attentes des uns et des autres inexprimées et se heurter dans certaines situations à la divergence des pratiques. Il vaut mieux toujours évoquer le maximum de cas
de figure avant la prise d’engagement. Il est très difficile d’imposer (ou d’accepter) une exigence
contraignante une fois la relation entamée.</p>

<p><b>Elle respecte les choix et les attentes des parents</b></p>
<p>Voilà à priori votre nounou est bien. Elle aime les enfants : vous l’avez vu très maternelle avec les
autres, elles leur fait des câlins et en plus elle a dit bonjour à votre propre bébé qui lui a souri. Elle
vous a parlé longuement des enfants qu’elle a gardés apparemment, plusieurs lettres des parents
contents à l’appui. Enfin, elle est disponible et le courant passe. Il est tout de même encore tôt
d’arrêter votre choix. De nombreux sujets méritent d’être abordés pour confirmer l’éventuelle
compatibilité de vos attentes avec les compétences et la démarche de la nounou.</p>
<p>Est-elle à l’écoute justement de vos attentes ? Demande-t-elle comment vous faites d’habitude pour
coucher le bébé, pour lui donner le repas, lui donner un bain ? Comment entendez-vous éduquer
votre enfant ? Quelles punitions vous semblent acceptables ?</p>

<p><b>Elle maîtrise la sécurité</b></p>
<p>Connaît-elle les démarches de sécurité ? Est-elle prête pour agir correctement en situation
d’urgence ? Posez-lui quelques questions pour la tester. Que fera-t-elle si l’enfant tombe et se fait
un bleu (cela va forcément arriver) ? Que fera-t-elle si l’enfant a de la fièvre ? Que fera-t-elle si
l’enfant tombe de la chaise-haute (cela, au contraire, ne doit pas normalement arriver) ?</p>

<p><b>Elle est bavarde</b></p>
<p>Est-elle assez bavarde ? Bien qu’être bavard ne peut pas être exigé d’une nounou, cela est tout de
même appréciable. Pendant ses premières années, l’enfant apprend à parler. Et plus on lui parle,
mieux il comprend le fonctionnement du langage et retient des mots. La nounou qui chante et qui
parle à l’enfant, même si ce dernier n’y fait guère attention, est une nounou bien attentionnée.
Connait-elle des comptines ? Ces petits morceaux de poésie enfantine facilitent le développement du
langage chez l’enfant. Demandez qu’elle vous chante sa comptine préférée. Vous pouvez aussi lui
chanter la vôtre.</p>

<p><b>Elle est une « boîte à idées »</b></p>
<p>Est-elle une « boîte à idées » connaissant des milliers d’activités à faire à tous les moments de la
journée, en fonction des capacités et de la prédisposition de l’enfant ? Vous n’espérez tout de même
pas que votre enfant apprenne toutes les publicités de la télé chez la nounou. Dites-lui votre attitude
envers la télévision. Demandez-lui quelle est son activité préférée. Est-elle plutôt du genre à proposer
ou à attendre que l’enfant lui propose des activités ? En bas âge, l’enfant connaît encore peu la
diversité des choses qu’on peut faire (en tout cas normalement moins que la nounou). Il est donc
normal qu’elle lui en fasse découvrir en lui proposant habituellement, tout en lui laissant des moments
de liberté pour s’exprimer et se construire.</p>

<p><b>Elle sait cuisiner</b></p>
<p>Qui ne rêve pas de bons petits plats tous les jours pour ses petits bouts de choux. La nounou qui sait
cuisiner, qui aime le faire et qui sait s’organiser pour le faire tout en gardant les enfants, en vaut deux. Demandez donc comment elle compte nourrir les enfants. Comment elle compose le menu ? Etes-
vous d’accord sur la part des produits bio dans l’assiette ? Comment se prend-t-elle pour
accompagner l’enfant dans la diversification ? Et si l’enfant ne veut pas manger les épinards,
partagez-vous la même attitude envers son comportement de refus ? Donne-t-elle des bonbons, des
gâteaux et d’autres sucreries aux enfants ? Fait-elle participer les enfants à la préparation des repas ?</p>

<p><b>Elle adore le plein air</b></p>
<p>L’enfant a besoin de sortir pour sa santé, son bien-être et son développement intellectuel. Plus il
passe de temps dehors en respirant l’air frais et en découvrant le monde environnant, mieux c’est.
Demandez à la nounou comment elle fait pour sortir avec les 3 ou 4 enfants à la fois (si elle en a
autant) ? Où va-t-elle habituellement ? Si elle garde l’enfant chez vous, suggérez lui les parcs et les
airs de jeux les plus proches. Comment organise-t-elle les sorties par rapport aux siestes de l’enfant ?
Assurez-vous que les sorties ne se résument pas à faire les propres courses de la nounou et chercher
ses propres enfants à l’école. Le temps dehors à découvrir et à jouer doit être une partie intégrante
de la journée et le bébé ne doit pas passer tout ce temps tout seul attaché dans la poussette. Il a
besoin qu’on lui parle, qu’on lui montre, qu’on lui explique ce qu’il voit et ce qu’il doit voir.</p>

<p><b>Chez elle, tout est propreté et organisation</b></p>
<p>Si votre enfant est gardé chez une assistante maternelle, son domicile sera le domicile de votre
enfant peut-être davantage que votre propre maison. Il doit s’y sentir bien ! La propreté est la
première qualité à rechercher lors de vos premières visites chez l’assistante maternelle. Si cette
dernière vous refuse l’accès à son domicile d’une manière régulière, méfiez-vous, signalez-le à la
PMI. Ce n’est pas normal. La maison doit être correctement équipée et organisée pour ne pas
présenter de danger pour votre petit bout. Soyez clair là-dessus. Plus tard, nous vous fournirons une
liste détaillée de différents points à observer et à aborder lors de votre première visite.</p>
<p>Même si vous n’avez pas droit d’interdire à la nounou ou à ses proches de fumer, l’absence de la
fumée dans la maison lors de l’accueil de votre enfant est une règle de base. Parlez-en dès le départ
et soyez vigilant par la suite.</p>
<p>La présence des animaux domestique est un autre sujet délicat. Vous êtes peut-être du genre à aimer
les animaux et vous réjouir que votre enfant grandisse à leurs côtés. Il semblerait d’ailleurs que les
animaux ont une influence positive scientifiquement approuvée sur les enfants. N’empêche pourtant
que la plupart des parents sont plus rassurés si leur enfant évolue dans un environnement sans
animaux domestiques. Parlez-en dès le départ et si cela représente un empêchement majeur pour
vous, cherchez ailleurs.</p>
<p>Y a-t-il un jardin chez la nounou ? Evidemment, la présence d’un jardin est un plus considérable et
parfois même un élément déterminant, notamment, dans certaines régions rurales.</p>
<p>La nounou a-t-elle une voiture, sait-elle conduire ? Sans que cela soit un critère indispensable pour
vous, il est important de savoir si votre enfant peut être amené à voyager dans la voiture de la
nounou. Dans ce cas, a-t-elle un siège adapté ? Acceptez-vous qu’elle fasse des trajets sans vous
prévenir ? Il est indispensable dans tous les cas de rédiger et signer une autorisation pour tout
transport de l’enfant en voiture.</p>

<p><b>Chez vous, elle accepte de donner un petit coup de main</b></p>
<p>Certes, vous ne pouvez pas l’exiger et cela se paye en forme de complément en général. Passer des
journées entières en s’occupant d’un bébé peut être épuisant et la nounou a besoin de se ressourcer.
N’empêche que les parents apprécient fort bien un petit coup de main pour le ménage, le repassage,
les repas ou même les devoirs des grands à la sortie de l’école. Surtout quand le bébé fait de longues
siestes... Mais ça, c’est à négocier avec pincettes. Rien ne peut obliger la nounou d’accepter des
tâches supplémentaires, et rien ne doit compromettre la qualité de ses interactions avec votre
enfant.</p>
<br>
<p>Et pour vous, quelles sont les qualités principales d’une « bonne nounou » ?</p>
<br>

<p><i>Par Anna Stépanoff</i></p>','is_activated' => '1','created_at' => '2014-05-20 16:46:18','updated_at' => '2014-05-22 01:05:21','miniPresentation' => 'Curieusement, je ne crois pas que nous allons avoir un débat sur ce qu’est une bonne nounou. Des
qualités que j’ai rassemblé ici sont issues de ...','onWelcomePage' => '1'),
            array('id' => '4','blog_category_id' => '271','title' => 'Du geste à la parole','presentation' => '<p><b>LES COMPTINES COMME SOURCE MAJEURE D\'APPRENTISSAGE DES TOUT-PETITS</b></p>

<p><i>Ainsi font font font<br>
Les petites marionnettes,<br>
Ainsi font font font<br>
Trois petits tours<br>
Et puis s\'en vont...</i></p>

<p>Qui ne connaît pas cette petite chanson simple qu’on chante à tous les bébés en faisant tourner les
mains devant soi ? « Il sait déjà faire les marionnettes ! » - se réjouit une maman. Son bébé vient en
effet de passer un cap en comprenant le rapport entre le geste et la parole. A force d’observer les
adultes tourner leurs mains dès qu’ils chantent « les marionnettes », le bébé se met à les imiter et
tourne ses petites mains en retour.</p>

<p>Chez l’humain l’apprentissage de la communication est d’abord gestuel. Couramment, les premiers
gestes signifiants de l’enfant en France sont « bravo » et « les marionnettes ». C’est vers 8-9 mois
qu’il y arrive en moyenne. Jusque là, l’enfant s’agitait, produisait des gestes et des bruits, se faisant
même parfois comprendre par ses proches. Mais sans maîtriser les gestes de la communauté, sa
communication demeurait restreinte. Après avoir réussi « bravo » et « les marionnettes », l’enfant
accède au langage commun. Cette première appropriation du langage passe souvent par des
comptines.</p>

<p>Les comptines, ces petites chansons faciles à retenir accompagnées de gestes, représentent ainsi une
source majeure d’apprentissage linguistique et culturel des tout-petits. Le bébé y découvre un peu
de tout : s’orienter dans l’espace, par exemple. Ainsi, dans la comptine sur la poule qui a caché son
oeuf, il cherche et apprend progressivement les notions du haut et du bas :</p>

<p><i>Cot cot cot cot<br>
Ma poule a pondu un oeuf,<br>
Mais où donc est-il caché?<br>
En haut ou en bas?</i></p>

<p>Dans d’autres, l’enfant s’initie aux mathématiques :</p>

<p><i>1 2 3 nous irons au bois,<br>
4 5 6 cueillir des cerises,<br>
7 8 9 dans mon panier neuf,<br>
10 11 12 elles seront toutes rouges.</i></p>

<p>Ou encore, il y apprend les règles de la vie en société, l’intérêt de l’effort collectif et les rôles
complémentaires de chacun :</p>

<p><i>Le pouce est allé au marché.<br>
Il a acheté un poulet.<br>
Celui-ci l\'a plumé.<br>
Celui-ci la fait cuire.<br>
Celui-ci l\'a mangé.<br>
Et le petit n\'a plus rien du tout;<br>
Alors ... lèche le plat.</i></p>

<p>LA BOITE A COMPTINES</p>

<p>Aujourd’hui, quand un parent veut apprendre les gestes et les paroles d’une comptine, il ou elle a
beaucoup de livres à sa disposition, quelques CDs, quelques sites internet. Pourtant il est difficile de
trouver une source unique, complète et pédagogique.... Encore mieux, le parent contemporain aurait
aimé avoir une application qui lui permette de visionner facilement des comptines en vidéo, ajouter
ses propres vidéos de comptines et les partager. Nous avons créé une telle application pour vous.
Elle s’appelle « <a href="http://www.laboiteacomptines.fr" title="La boite à comptines">La boîte à comptines</a> ».</p>

<p>Qu’elle est votre comptine préférée ? En chantez-vous souvent à vos enfants ?</p>
<br>

<p><i>Par Anna Stépanoff</i></p>','is_activated' => '1','created_at' => '2014-05-20 16:56:01','updated_at' => '2014-05-20 21:21:43','miniPresentation' => 'Les comptines représentent une source majeure d\'apprentissage des tout-petits. Qui ne connaît pas ces petites chansons faciles à retenir...','onWelcomePage' => '1'),
            array('id' => '5','blog_category_id' => '266','title' => 'Pour un accueil d’enfant de qualité','presentation' => '<p>Elles sont plusieurs centaines de milliers en France à s’occuper de nos enfants. Ces femmes (et
hommes parfois) ont choisi comme métier de faire grandir et éveiller les enfants des autres. Un
métier extrêmement nécessaire dans une société où les deux sexes travaillent. Parmi ces personnes,
seules les professionnelles de crèches et les assistantes maternelles sont véritablement formées, car
une formation est indispensable à l’exercice de leur métier.</p>

<p>Or il y a aussi toutes celles qui gardent les enfants au domicile des parents et qu’on appelle
officiellement les auxiliaires parentales et plus familièrement les gardes ou nourrices à domicile. Elles
sont près de 100 000 rien qu’en Ile de France. Ces personnes se retrouvent souvent face à des
enfants inconnus sans aucune formation préalable et avec pour seule expérience la garde de leurs
propres enfants.</p>

<p>Je ne parle même pas des baby-sitters, nombreux, qui font de la garde d’enfant temporairement
pour financer leurs études ou comme job d’appoint. Ils ont aussi besoin de se former, d’apprendre
les gestes de base, de comprendre l’enfant et ses besoins.</p>

<p>Certes, il existe des formations adaptées un peu partout en France. Malheureusement, ces
formations ont lieu le plus souvent en semaine, précisément quand l’enfant doit être accueilli et
donc quand la nounou n’est pas disponible.</p>

<p>Il nous tient à coeur d’apporter des solutions alternatives de formation à toutes ces personnes qui en
ont besoin. Ainsi, parent-nounou.fr s’attelle à la longue tâche de collecter conseils et astuces et de
les mettre à la disposition des gardes d’enfant gratuitement sur notre plateforme. Nous développons
également une série de quiz en ligne pour tester vos connaissances dans le domaine de la petite
enfance et projetons de mettre en place un véritable parcours de formation accessible au plus grand
nombre.</p>

<p>Afin d’encourager une garde de qualité, le moteur de recherche du site parent-nounou.fr est basé
sur un système de points de confiance. Ces derniers se gagnent par la qualité des informations
fournies, mais également en travaillant et en se formant progressivement. Ainsi, grâce à l’intelligence
de notre moteur de recherche, les nounous les plus qualifiées et motivées seront valorisées dans les
résultats de recherche. Il n’est pas possible d’acheter la visibilité sur parent-nounou.fr. Seules vos
qualités professionnelles et vos compétences vous aideront à occuper la meilleure position.</p>','is_activated' => '1','created_at' => '2014-05-20 16:57:46','updated_at' => '2014-05-20 18:13:12','miniPresentation' => 'Elles sont plusieurs centaines de milliers en France à s’occuper de nos enfants. Ces femmes (et
hommes parfois) ont choisi comme métier de faire grandir ...','onWelcomePage' => '0'),
            array('id' => '6','blog_category_id' => '266','title' => 'E-certification','presentation' => '<p>Dans le souci de mettre en place un véritable parcours de formation accessible à tous, nous avons
inventé une certification numérique des compétences de garde d’enfant. Elle se compose de 8
badges correspondants à 8 domaines clés de la petite enfance :</p>

<ol>
<li>Sécurité et prévention des accidents</li>
<li>Santé et croissance de l’enfant</li>
<li>Développement psychomoteur, socio-affectif et cognitif de l’enfant</li>
<li>Choisir les activités d’éveil et de jeu selon l’âge</li>
<li>Gestes du quotidien</li>
<li>Alimentation</li>
<li>Droits et obligations des gardes d’enfant</li>
<li>Communiquer efficacement avec les parents</li>
</ol>

<p>Dans chaque domaine, vous pouvez obtenir un badge de bronze, d’argent ou d’or. Les 3 types de
badges correspondent à 3 niveaux de progression dans les compétences petite enfance :</p>

<ul>
<li>Le BADGE DE BRONZE sanctionne les connaissances théoriques que vous pouvez valider en
passant des quiz en ligne</li>
<li>Le BADGE D’ARGENT sanctionne vos connaissances pratiques acquises dans des formations
partenaires</li>
<li>Le BADGE D’OR enfin est attribué suite à la validation de vos connaissances par les parents</li>
</ul>

<p>Tout cela sera mis en place progressivement. N’hésitez pas à nous envoyer vos remarques et
suggestions d’amélioration. L’objectif est de créer un système de certification en ligne simple
d’utilisation et efficace dans la valorisation de vos savoirs et savoir-faire.</p>','is_activated' => '1','created_at' => '2014-05-20 17:00:31','updated_at' => '2014-05-20 17:25:12','miniPresentation' => 'Dans le souci de mettre en place un véritable parcours de formation accessible à tous, nous avons
inventé une certification numérique des ...','onWelcomePage' => '0'),
            array('id' => '7','blog_category_id' => '266','title' => 'La garde : un moyen de renforcer la socialisation de l\'enfant','presentation' => '<p>De la grossesse à la fin du congé maternité, le nourrisson est en contact quasi permanent avec ses
parents. Ceux-ci sont habitués à analyser, comprendre ses besoins et à y répondre autant que
possible. Certains pères ou mères ont une relation très fusionnelle avec leur enfant. C’est pourquoi
il aura besoin d’une « défusion » pour s\'ouvrir au monde extérieur.</p>
<p>Cela représente un aspect fondamental du développement de l\'enfant car la socialisation conditionne
l\'intégration du futur adulte dans la société.</p>
<h3>La rencontre avec d\'autres adultes</h3>
<p>Lorsque le jeune enfant est mis en garde chez une nourrice par exemple, il crée des liens sécurisants
avec des adultes différents de ses parents. Ainsi, il reçoit de l\'affection de plusieurs personnes, ce
qui l\'aide à comprendre entre autres, quels sont les comportements sociaux acceptables en société.</p>
<p>Dans son cercle familial, l\'enfant se fait comprendre très aisément. Chez la nourrice ou la Baby-
sitteur, pour être compris et s\'affirmer, l\'enfant doit améliorer sa façon de communiquer,
verbalement et non verbalement. Savoir communiquer joue un rôle très important dans le
développement des habiletés sociales.</p>
<h3>La rencontre avec d\'autres enfants</h3>
<p>Les enfants sont capables de s\'engager dans des relations sociales avec d\'autres petits et ce dès l\'âge
de six mois. À cet âge par exemple, les bébés peuvent échanger des jouets. Entre 10 et 12 mois, le
bébé peut pleurer lorsqu\'un autre est en larmes. Vers 13 ou 14 mois, il embrassera l\'enfant qui
pleure. Ces exemples montrent que, très jeune, l\'enfant est sensible aux personnes qui l\'entourent et
spécialement aux autres enfants. Comme le souligne Pauline Carignan (revue Petit à Petit,
publication de L’Office des services de garde à l’enfance, novembre-décembre 1994, volume 13,
numéro 4), le milieu de garde devient donc <i>« un lieu privilégié d\'apprentissage social puisqu\'il
permet au bébé d\'observer, d\'imiter, d\'exprimer ses compétences sociales en jouant avec des enfants
de son âge. »</i></p>
<div style="text-align: right;">Emilie Balleriaud</div>
<!-- Placez cette balise où vous souhaitez faire apparaître le gadget widget. -->
<div class="g-person" data-href="https://plus.google.com/109554345060880706764" data-layout="landscape" data-rel="author"></div>

<!-- Placez cette ballise après la dernière balise widget. -->
<script type="text/javascript">
  window.___gcfg = {lang: \'fr\'};

  (function() {
    var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
    po.src = \'https://apis.google.com/js/platform.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>','is_activated' => '1','created_at' => '2014-06-13 13:12:16','updated_at' => '2014-06-17 09:45:31','miniPresentation' => 'De la grossesse à la fin du congé maternité, le nourrisson est en contact quasi permanent avec ses...','onWelcomePage' => '0')
        );

        foreach ($blog_articles as $article)
        {
            $post = $postManager->create();
            $post->setTitle($article["title"]);
            $post->setRawContent($article["presentation"]);
            $post->setContentFormatter('markdown');
            $post->setContent($this->getPoolFormatter()->transform($post->getContentFormatter(), $post->getRawContent()));
            $post->setEnabled(true);
            $post->setCreatedAt(\DateTime::createFromFormat ("Y-m-d H:i:s", $article["created_at"]));
            if ($article["updated_at"])
                $post->setUpdatedAt(\DateTime::createFromFormat ("Y-m-d H:i:s", $article["updated_at"]));
            $post->setAbstract("miniPresentation");
            $post->setOnHomePage($article["onWelcomePage"]);

            $post->setCommentsDefaultStatus(CommentInterface::STATUS_VALID);
            if ($article["blog_category_id"] == '266')
                $post->setCollection($this->getReference('collection-alaune'));
            if ($article["blog_category_id"] == '270')
                $post->setCollection($this->getReference('collection-droit'));
            if ($article["blog_category_id"] == '269')
                $post->setCollection($this->getReference('collection-dialogue'));
            if ($article["blog_category_id"] == '271')
                $post->setCollection($this->getReference('collection-eveil'));

            $postManager->save($post);
        }

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