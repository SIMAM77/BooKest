<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class NotificationAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
			->add('id')
			->add('id_emprunteur')
			->add('id_preteur')
			->add('id_livre')
			->add('date_start')
			->add('date_end')
			->add('status_emprunt')
			->add('quantity')
			;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
			->add('id')
			->add('id_emprunteur')
			->add('id_preteur')
			->add('id_livre')
			->add('date_start')
			->add('date_end')
			->add('status_emprunt')
			->add('quantity')
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
			->add('id_emprunteur')
			->add('id_preteur')
			->add('id_livre')
			->add('date_start')
			->add('date_end')
			->add('status_emprunt')
			->add('quantity')
			;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
			->add('id')
			->add('id_emprunteur')
			->add('id_preteur')
			->add('id_livre')
			->add('date_start')
			->add('date_end')
			->add('status_emprunt')
			->add('quantity')
			;
    }
}
