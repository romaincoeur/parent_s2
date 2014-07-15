<?php

namespace Pn\PnBundle\Block\Service;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\Security\Core\SecurityContext;

class ControlsBlockService extends BaseBlockService
{
    private $context;

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse('PnPnBundle:Block:block_controls.html.twig', array(
            'context'   => $blockContext,
            'settings'  => $blockContext->getSettings(),
            'block'     => $blockContext->getBlock(),
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

    public function __construct($name, $templating, SecurityContext $context)
    {
        parent::__construct($name, $templating);
        $this->context = $context;
    }
}