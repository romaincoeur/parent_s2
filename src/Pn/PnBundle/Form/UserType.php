<?php

namespace Pn\PnBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Pn\PnBundle\Form\BabysitterCategoryType;

class UserType extends AbstractType
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
                ))
            )
            ->add('lastname', 'text', array(
                'attr' => array(
                    'placeholder' => 'Nom',
                ))
            )
            ->add('email'
                , 'text', array(
                    'attr' => array(
                        'placeholder' => 'E-mail',
                    ))
            )
            ->add('rawPassword', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'mot de passe invalide',
                'options' => array('required' => true),
                'first_options' => array('label' => 'Mot de passe', 'attr' => array(
                        'placeholder' => 'Mot de passe',
                    )),
                'second_options' => array('label' => 'Mot de passe (validation)', 'attr' => array(
                        'placeholder' => 'Confirmation du mot de passe',
                    )),
            ))
            ->add('type', 'choice', array(
                'choices'   => array('parent' => 'Je suis parent', 'nounou' => 'Je suis nounou'),
                'expanded' => true,
                'required'  => true,
                'data' => 'parent',
            ))
            ->add('babysitter', new BabysitterCategoryType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pn\PnBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pn_pnbundle_user';
    }
}
