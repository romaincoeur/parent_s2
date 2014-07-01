<?php

namespace Application\Sonata\UserBundle\Form\Type;

use Application\Sonata\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends AbstractType
{

    private $class;

    /**
     * @var array
     */
    protected $mergeOptions;

    /**
     * @param string $class        The User class name
     * @param array  $mergeOptions Add options to elements
     */
    public function __construct($class, array $mergeOptions = array())
    {
        $this->class        = $class;
        $this->mergeOptions = $mergeOptions;
    }

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
            ->add('plainPassword', 'repeated', array_merge(array(
                'type' => 'password',
                'options' => array('translation_domain' => 'SonataUserBundle'),
                'first_options' => array('label' => 'Mot de passe', 'attr' => array(
                    'placeholder' => 'Mot de passe',
                )),
                'second_options' => array('label' => 'Mot de passe (validation)', 'attr' => array(
                    'placeholder' => 'Confirmation du mot de passe',
                )),
                'invalid_message' => 'fos_user.password.mismatch',
            ), $this->mergeOptions))
            ->add('type', 'choice', array(
                'choices'   => array('parent' => 'Je suis parent', 'nounou' => 'Je suis nounou'),
                'expanded' => true,
                'required'  => true,
                'data' => 'parent',
            ))
            ->add('secondType', 'choice', array(
                'choices'   => User::getsecondTypes(),
                'expanded' => false,
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
            'data_class' => $this->class,
            'intention'  => 'registration',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'application_sonata_user_registration';
    }
}
