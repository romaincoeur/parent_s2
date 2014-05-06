<?php

namespace Pn\PnBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
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
                ),
                'required'  => true,
            ))
            ->add('lastname', 'text', array(
                'attr' => array(
                    'placeholder' => 'Nom',
                ),
                'required'  => true,
            ))
            ->add('email', 'text', array(
                'attr' => array(
                    'placeholder' => 'E-mail',
                ),
                'required'  => true,
            ))
            ->add('message', 'textarea', array(
                'attr' => array(
                    'placeholder' => 'Votre message',
                    'rows' => 4,
                ),
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
            'data_class' => 'Pn\PnBundle\Form\Model\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'contact';
    }
}
