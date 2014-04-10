<?php

namespace Pn\PnBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Pn\PnBundle\Entity\Job;
use Pn\PnBundle\Entity\Babysitter;


class BabysitterType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('presentation', 'textarea', array(
                'attr' => array(
                    'placeholder' => 'Décrivez-vous en quelques lignes',
                )
            ))
            ->add('rate_price', 'text', array(
                'attr' => array(
                    'placeholder' => 'Votre tarif',
                )
            ))
            ->add('rate_type', 'choice', array(
                'choices'   => Job::getRateTypes(),
                'expanded' => false,
                'required'  => true,
            ))
            ->add('experience')
            ->add('anythingelse')
            ->add('favoriteactivities')
            ->add('hobbies')
            ->add('file', 'file', array('label' => 'Photo de profil', 'required' => false))
            ->add('user', new UserFullType())
            ->add('calendar', 'hidden')
            ->add('petitsplus', 'choice', array(
                'choices'   => Babysitter::getPetitspluss(),
                'expanded' => true,
                'multiple' => true,
                'required'  => true,
            ))
            ->add('particularite', 'choice', array(
                'choices'   => Babysitter::getParticularites(),
                'expanded' => true,
                'multiple' => true,
                'required'  => true,
            ))
            ->add('diplomas', 'choice', array(
                'choices'   => Babysitter::getDiplomass(),
                'expanded' => true,
                'multiple' => true,
                'required'  => true,
            ))
            ->add('ageOfChildren', 'choice', array(
                'choices'   => Babysitter::getAgeofchildrens(),
                'expanded' => true,
                'multiple' => true,
                'required'  => true,
            ))
            ->add('languages', 'choice', array(
                'choices'   => Babysitter::getLanguagess(),
                'expanded' => true,
                'multiple' => true,
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
