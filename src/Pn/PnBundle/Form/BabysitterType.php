<?php

namespace Pn\PnBundle\Form;

use Application\Sonata\UserBundle\Entity\User;
use Application\Sonata\UserBundle\Form\Type\UserFullType;
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
            ->add('presentation', 'genemu_tinymce', array(
                'attr' => array(
                    'placeholder' => 'Décrivez-vous en quelques lignes',
                ),
                'required'  => false,
            ))
            ->add('rate_price', 'text', array(
                'attr' => array(
                    'placeholder' => 'Votre tarif',
                ),
                'required'  => false,
            ))
            ->add('rate_type', 'choice', array(
                'choices'   => User::getRateTypes(),
                'expanded' => false,
                'required'  => false,
            ))
            ->add('experience', 'integer',array(
                'attr' => array('min' => 0)
            ))
            ->add('extraTasks', 'choice', array(
                'choices'   => User::getExtraTaskss(),
                'expanded' => true,
                'multiple' => true,
                'required'  => false,
            ))
            ->add('favoriteactivities', 'text', array(
                'attr' => array(
                    'placeholder' => 'Vos activités avec les enfants',
                ),
                'required'  => false,
            ))
            ->add('hobbies', 'text', array(
                'attr' => array(
                    'placeholder' => 'Vos loisirs',
                ),
                'required'  => false,
            ))
            ->add('user', new UserFullType(), array(
                'label' => false
            ))
            ->add('calendar', 'hidden')
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
