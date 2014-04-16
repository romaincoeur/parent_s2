<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 26/03/14
 * Time: 14:32
 */

// src/Pn/PnBundle/Admin/UserAdmin.php

namespace Pn\PnBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends Admin
{
    // setup the default sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'firstname'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('type')
            ->add('birthdate')
            ->add('address')
            ->add('latitude')
            ->add('longitude')
            ->add('phone')
            ->add('created_at')
            ->add('updated_at')
            ->add('is_activated')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('type')
            ->add('is_activated')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('firstname')
            ->add('lastname')
            ->add('email')
            ->add('type')
            ->add('address')
            ->add('created_at')
            ->add('updated_at')
            ->add('is_activated')
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
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('type')
            ->add('birthdate')
            ->add('address')
            ->add('latitude')
            ->add('longitude')
            ->add('phone')
            ->add('created_at')
            ->add('updated_at')
            ->add('is_activated')
            ->add('confirmed')
            ->add('confirmationToken')

        ;
    }
}