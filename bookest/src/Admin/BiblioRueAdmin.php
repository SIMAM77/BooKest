<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class BiblioRueAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
			->add('id')
			->add('name')
			->add('adress')
			->add('photo')
			->add('geolocalization')
			->add('score')
			->add('comments')
			;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
			->add('id')
			->add('name')
			->add('adress')
			->add('photo')
			->add('geolocalization')
			->add('score')
			->add('comments')
			->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
			->add('id')
			->add('name')
			->add('adress')
			->add('photo')
			->add('geolocalization')
			->add('score')
			->add('comments')
			;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
			->add('id')
			->add('name')
			->add('adress')
			->add('photo')
			->add('geolocalization')
			->add('score')
			->add('comments')
			;
    }
}
