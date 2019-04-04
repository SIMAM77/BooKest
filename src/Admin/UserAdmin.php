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
			->add('username')
			->add('usernameCanonical')
			->add('email')
			->add('emailCanonical')
			->add('enabled')
			->add('salt')
			->add('password')
			->add('lastLogin')
			->add('confirmationToken')
			->add('passwordRequestedAt')
			->add('roles')
			->add('id')
			;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
			->add('username')
			->add('usernameCanonical')
			->add('email')
			->add('emailCanonical')
			->add('enabled')
			->add('salt')
			->add('password')
			->add('lastLogin')
			->add('confirmationToken')
			->add('passwordRequestedAt')
			->add('roles')
			->add('id')
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
			->add('usernameCanonical')
			->add('email')
			->add('emailCanonical')
			->add('enabled')
			->add('salt')
			->add('password')
			->add('lastLogin')
			->add('confirmationToken')
			->add('passwordRequestedAt')
			->add('roles')
			->add('id')
			;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
			->add('username')
			->add('usernameCanonical')
			->add('email')
			->add('emailCanonical')
			->add('enabled')
			->add('salt')
			->add('password')
			->add('lastLogin')
			->add('confirmationToken')
			->add('passwordRequestedAt')
			->add('roles')
			->add('id')
			;
    }
}
