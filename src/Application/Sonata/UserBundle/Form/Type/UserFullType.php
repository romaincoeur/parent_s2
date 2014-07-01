<?php

namespace Application\Sonata\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserFullType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text', array(
                'attr' => array(
                    'placeholder' => 'Prénom',
                )
            ))
            ->add('lastname', 'text', array(
                'attr' => array(
                    'placeholder' => 'Nom',
                )
            ))
            ->add('phone', 'text', array(
                'attr' => array(
                    'placeholder' => 'Numero de téléphone',
                )
            ))
            ->add('latitude', 'hidden')
            ->add('longitude', 'hidden')
            ->add('address', 'text', array(
                'attr' => array(
                    'placeholder' => 'Où habitez-vous ?',
                )
            ))
            ->add('dateOfBirth', 'birthday', array(
                'attr' => array(
                    'placeholder' => 'Votre date de naissance',
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
            'data_class' => 'Application\Sonata\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'application_sonata_userbundle_userfull';
    }
}
