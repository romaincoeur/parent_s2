<?php

namespace Application\Sonata\NewsBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Collection;

class CommentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('message')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'application_sonata_post_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {;
        $resolver->setDefaults(array(
            'translation_domain' => 'SonataNewsBundle'
        ));
    }
}
