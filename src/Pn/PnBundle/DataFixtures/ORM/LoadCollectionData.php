<?php


namespace Pn\PnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadCollectionData
 *
 * @package Sonata\Bundle\EcommerceDemoBundle\DataFixtures\ORM
 *
 * @author  Hugo Briand <briand@ekino.com>
 */
class LoadCollectionData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Returns the Sonata MediaManager.
     *
     * @return \Sonata\CoreBundle\Model\ManagerInterface
     */
    public function getCollectionManager()
    {
        return $this->container->get('sonata.classification.manager.collection');
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $em)
    {
        for ($i=0;$i<9;$i++)
        {
            // collection
            $media = $em->merge($this->getReference('media-'.$i));
            $slug = substr($media->getName(), 0, -4);
            $collection = $this->getCollectionManager()->create();
            $collection->setSlug($slug);
            $collection->setName($slug);
            $collection->setMedia($media);
            $collection->setEnabled(true);
            $this->getCollectionManager()->save($collection);
            $this->addReference('collection-'.$slug, $collection);
        }

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4;
    }
}
