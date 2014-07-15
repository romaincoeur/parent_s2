<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 26/03/14
 * Time: 14:33
 */

// src/Pn/PnBundle/Admin/JobAdmin.php

namespace Pn\PnBundle\Admin;

use Application\Sonata\UserBundle\Entity\User;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

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
            ->add('title')
            ->add('presentation')
            ->add('status')
            ->add('parent')
            ->add('rate_price')
            ->add('rate_type', 'choice', array(
                'choices'   => array('hour' => 'Heure', 'month' => 'Mois', 'forfait' => 'Forfait'),
                'required'  => true,
            ))
            ->add('address')
            ->add('latitude')
            ->add('longitude')
            ->add('duration')
            ->add('how_to_apply')
            ->add('calendar')
            ->add('category', 'choice', array(
                'choices'   => User::getsecondTypes(),
                'expanded' => false,
                'multiple' => false,
                'required'  => true,
            ))
            ->add('experience')
            ->add('expires_at')
            ->add('is_public')
            ->add('is_activated')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('is_activated')
            ->add('address')
            ->add('parent')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('status')
            ->add('parent')
            ->add('category')
            ->add('unacurateAddress')
            ->add('is_activated', null, array('editable' => true))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('presentation')
            ->add('status')
            ->add('parent')
            ->add('address')
            ->add('unacurateAddress')
            ->add('latitude')
            ->add('longitude')
            ->add('rate_price')
            ->add('rate_type')
            ->add('duration')
            ->add('how_to_apply')
            ->add('calendar')
            ->add('category')
            ->add('experience')
            ->add('expires_at')
            ->add('created_at')
            ->add('updated_at')
            ->add('is_public')
            ->add('is_activated')
        ;
    }
}
