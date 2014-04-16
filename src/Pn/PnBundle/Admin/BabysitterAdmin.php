<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 26/03/14
 * Time: 14:32
 */

// src/Pn/PnBundle/Admin/BabysitterAdmin.php

namespace Pn\PnBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Pn\PnBundle\Entity\Babysitter;

class BabysitterAdmin extends Admin
{
    // setup the default sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'title'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('file', 'file', array('label' => 'Avatar', 'required' => false))
            ->add('trustpoints','integer')
            ->add('presentation')
            ->add('rate_price')
            ->add('rate_type')
            ->add('category')
            ->add('diplomas')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('trustpoints')
            ->add('rate_price')
            ->add('rate_type')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('userUsername')
            ->add('category')
            ->add('trustpoints')
            ->add('rate_price')
            ->add('rate_type')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('userUsername')
            ->add('avatar')
            ->add('trustpoints')
            ->add('presentation')
            ->add('rate_price')
            ->add('rate_type')
            ->add('category')
            ->add('diplomas', 'choice', array(
                'choices'   => Babysitter::getDiplomass(),
                'expanded' => true,
                'multiple' => true,
                'required'  => true,
            ))
        ;
    }
}