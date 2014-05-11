<?php

namespace Pn\PnBundle\Form;

use Pn\PnBundle\Entity\Babysitter;
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
                'choices'   => Job::getRateTypes(),
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
                'choices'   => Babysitter::getDiplomass(),
                'expanded' => true,
                'multiple' => true,
                'required'  => false,
            ))
            ->add('ageOfChildren', 'choice', array(
                'choices'   => Babysitter::getAgeofchildrens(),
                'expanded' => true,
                'multiple' => true,
                'required'  => false,
            ))
            ->add('languages', 'choice', array(
                'choices'   => Babysitter::getLanguagess(),
                'expanded' => true,
                'multiple' => true,
                'required'  => false,
            ))
            ->add('petitsplus', 'choice', array(
                'choices'   => Babysitter::getPetitspluss(),
                'expanded' => true,
                'multiple' => true,
                'required'  => false,
            ))
            ->add('particularite', 'choice', array(
                'choices'   => Babysitter::getParticularites(),
                'expanded' => true,
                'multiple' => true,
                'required'  => false,
            ))
            ->add('extraTasks', 'choice', array(
                'choices'   => Babysitter::getExtraTaskss(),
                'expanded' => true,
                'multiple' => true,
                'required'  => false,
            ))
            ->add('phone', 'text', array(
                'attr' => array(
                    'placeholder' => 'Numero de téléphone',
                )
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
