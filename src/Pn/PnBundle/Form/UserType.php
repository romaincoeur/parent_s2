<?php

namespace Pn\PnBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('rawPassword', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'mot de passe invalide',
                'options' => array('required' => true),
                'first_options' => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Mot de passe (validation)'),
            ))
            ->add('type', 'choice', array(
                'choices'   => array('parent' => 'Parent', 'nounou' => 'Nounou'),
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
