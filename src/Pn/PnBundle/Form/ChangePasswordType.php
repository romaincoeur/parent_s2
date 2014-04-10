<?php

namespace Pn\PnBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangePasswordType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', 'password', array(
                'attr' => array(
                    'placeholder' => 'Ancien mot de passe',
                )
            ))
            ->add('newPassword', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'options' => array('required' => true),
                'first_options' => array('label' => 'Mot de passe', 'attr' => array(
                    'placeholder' => 'Nouveau mot de passe',
                )),
                'second_options' => array('label' => 'Mot de passe (validation)', 'attr' => array(
                    'placeholder' => 'Confirmation du mot de passe',
                )),
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pn\PnBundle\Form\Model\ChangePassword'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'change_password';
    }
}
