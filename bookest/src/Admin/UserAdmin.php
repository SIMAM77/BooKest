<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class UserAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
			->add('id')
			->add('login')
			->add('pass')
			->add('name')
			->add('firstname')
			->add('email')
			->add('adresse')
			->add('status')
			->add('facebook_id')
			->add('google_id')
			->add('id_cercle')
			;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
			->add('id')
			->add('login')
			->add('pass')
			->add('name')
			->add('firstname')
			->add('email')
			->add('adresse')
			->add('status')
			->add('facebook_id')
			->add('google_id')
			->add('id_cercle')
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
			->add('login')
			->add('pass')
			->add('name')
			->add('firstname')
			->add('email')
			->add('adresse')
			->add('status')
			->add('facebook_id')
			->add('google_id')
			->add('id_cercle')
			;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
			->add('id')
			->add('login')
			->add('pass')
			->add('name')
			->add('firstname')
			->add('email')
			->add('adresse')
			->add('status')
			->add('facebook_id')
			->add('google_id')
			->add('id_cercle')
			;
    }
}
