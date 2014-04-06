<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 26/03/14
 * Time: 14:32
 */

// src/Pn/PnBundle/Admin/MoocAdmin.php

namespace Pn\PnBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Pn\PnBundle\Entity\Mooc;


class MoocAdmin extends Admin
{
    // setup the default sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'title'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('presentation')
            ->add('category', 'choice', array(
                'choices'   => Mooc::getCategories(),
                'expanded' => false,
                'required'  => true,
            ))
            ->add('is_activated')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('category')
            ->add('is_activated')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('presentation')
            ->add('category')
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
            ->add('title')
            ->add('presentation')
            ->add('category')
            ->add('updated_at')
            ->add('created_at')
            ->add('is_activated')
        ;
    }
}