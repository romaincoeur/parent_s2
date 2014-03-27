<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 26/03/14
 * Time: 14:33
 */

// src/Pn/PnBundle/Admin/JobAdmin.php

namespace Pn\PnBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Pn\PnBundle\Entity\Job;

class JobAdmin extends Admin
{
    // setup the defaut sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'created_at'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('babysittercategory')
            ->add('title')
            ->add('description')
            ->add('rate_price')
            ->add('rate_type', 'choice', array(
                'choices'   => array('hour' => 'Heure', 'month' => 'Mois', 'forfait' => 'Forfait'),
                'required'  => true,
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('babysittercategory')
            ->add('title')
            ->add('description')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('babysittercategory')
            ->add('expires_at')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('babysittercategory')
            ->add('title')
            ->add('description')
        ;
    }
}