<?php

namespace Pn\PnBundle\Form;

use Pn\PnBundle\Entity\Babysitter;
use Pn\PnBundle\Entity\User;
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
            ->add('title', 'text', array(
                'attr' => array(
                    'placeholder' => 'Titre de l\'annonce',
                ),
                'required'  => false,
            ))
            ->add('description', 'textarea', array(
                'attr' => array(
                    'placeholder' => 'Présentez votre annonce en quelques lignes',
                ),
                'required'  => false,
            ))
            ->add('address', 'text', array(
                'attr' => array(
                    'placeholder' => 'Adresse',
                ),
                'required'  => false,
            ))
            ->add('latitude', 'hidden')
            ->add('longitude', 'hidden')
            ->add('rate_price', 'text', array(
                'attr' => array(
                    'placeholder' => 'Salaire',
                ),
                'required'  => false,
            ))
            ->add('rate_type', 'choice', array(
                'choices'   => User::getRateTypes(),
                'expanded' => false,
                'required'  => false,
            ))
            ->add('calendar', 'hidden')
            ->add('experience', 'integer',array(
                'attr' => array('min' => 0)
            ))
            ->add('parent', new PparentType(), array(
                'label' => false
            ))
            ->add('start', 'date')
            ->add('end', 'date')
            ->add('diplomas', 'choice', array(
                'choices'   => User::getDiplomass(),
                'expanded' => true,
                'multiple' => true,
                'required'  => false,
            ))
            ->add('ageOfChildren', 'choice', array(
                'choices'   => User::getAgeofchildrens(),
                'expanded' => true,
                'multiple' => true,
                'required'  => false,
            ))
            ->add('languages', 'choice', array(
                'choices'   => User::getLanguagess(),
                'expanded' => true,
                'multiple' => true,
                'required'  => false,
            ))
            ->add('petitsplus', 'choice', array(
                'choices'   => User::getPetitspluss(),
                'expanded' => true,
                'multiple' => true,
                'required'  => false,
            ))
            ->add('particularite', 'choice', array(
                'choices'   => User::getParticularites(),
                'expanded' => true,
                'multiple' => true,
                'required'  => false,
            ))
            ->add('extraTasks', 'choice', array(
                'choices'   => User::getExtraTaskss(),
                'expanded' => true,
                'multiple' => true,
                'required'  => false,
            ))
            ->add('phone', 'text', array(
                'attr' => array(
                    'placeholder' => 'Numero de téléphone',
                )
            ))
            ->add('category', 'choice', array(
                'choices'   => User::getsecondTypes(),
                'expanded' => true,
                'multiple' => false,
                'required'  => true,
            ))
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
