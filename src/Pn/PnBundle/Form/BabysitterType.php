<?php

namespace Pn\PnBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BabysitterType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('presentation')
            ->add('hourlyrate')
            ->add('experience')
            ->add('trustpoints')
            ->add('anythingelse')
            ->add('ageofchildren')
            ->add('availabilities')
            ->add('favoriteactivities')
            ->add('hobbies')
            ->add('mychildren')
            ->add('babysittercategory')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pn\PnBundle\Entity\Babysitter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pn_pnbundle_babysitter';
    }
}
