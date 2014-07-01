<?php

namespace Pn\PnBundle\Block\Service;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Doctrine\ORM\EntityManager;

class StatisticsBlockService extends BaseBlockService
{
    private $em;

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $block, Response $response = null)
    {
        $userRepository = $this->em->getRepository('ApplicationSonataUserBundle:User');
        $babysitterRepository = $this->em->getRepository('PnPnBundle:Babysitter');
        $parentRepository = $this->em->getRepository('PnPnBundle:Pparent');
        $nbUsers = $userRepository->count();
        $nbNounou = $babysitterRepository->count();
        $nbParents = $parentRepository->count();

        return $this->renderResponse('PnPnBundle:Block:block_statistics.html.twig', array(
            'block'     => $block,
            'nbUsers' => $nbUsers,
            'nbNounous' => $nbNounou,
            'nbParents' => $nbParents,
        ), $response);
    }

    /**
     * {@inheritdoc}
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
        // TODO: Implement validateBlock() method.
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(
                array('content', 'textarea', array()),
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Text (core)';
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultSettings()
    {
        return array(
            'content' => 'Insert your custom content here',
        );
    }

    public function __construct($name, $templating, EntityManager $entityManager)
    {
            parent::__construct($name, $templating);
            $this->em = $entityManager;
    }
}