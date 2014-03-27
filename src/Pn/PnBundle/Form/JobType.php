<?php

namespace Pn\PnBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Pn\PnBundle\Entity\Job;

class JobType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('address', 'hidden')
            ->add('latitude', 'hidden')
            ->add('longitude', 'hidden')
            ->add('rate_price')
            ->add('rate_type', 'choice', array(
                'choices'   => Job::getRateTypes(),
                'expanded' => false,
                'required'  => true,
            ))
            ->add('calendar', 'hidden')
            ->add('token')
            ->add('babysittercategory')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pn\PnBundle\Entity\Job'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pn_pnbundle_job';
    }
}
