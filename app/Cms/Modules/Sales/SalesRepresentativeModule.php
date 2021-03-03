<?php declare(strict_types = 1);

namespace App\Cms\Modules\Sales;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Sales\ISalesRepresentativeRepository;
use App\Domain\Entities\Sales\SalesRepresentative;
use Dms\Common\Structure\Field;
use App\Domain\Entities\Enums\Status;

/**
 * The sales-representative module.
 */
class SalesRepresentativeModule extends CrudModule
{


    public function __construct(ISalesRepresentativeRepository $dataSource, IAuthSystem $authSystem)
    {

        parent::__construct($dataSource, $authSystem);
    }

    /**
     * Defines the structure of this module.
     *
     * @param CrudModuleDefinition $module
     */
    protected function defineCrudModule(CrudModuleDefinition $module)
    {
        $module->name('sales-representative');

        $module->labelObjects()->fromProperty(SalesRepresentative::CODE);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->string()
                )->bindToProperty(SalesRepresentative::CODE),
                //
                $form->field(
                    Field::create('name', 'Name')->string()
                )->bindToProperty(SalesRepresentative::NAME),
                //
                $form->field(
                    Field::create('phone', 'Phone')->string()
                )->bindToProperty(SalesRepresentative::PHONE),
                //
                $form->field(
                    Field::create('cell', 'Cell')->string()
                )->bindToProperty(SalesRepresentative::CELL),
                //
                $form->field(
                    Field::create('email', 'Email')->email()
                )->bindToProperty(SalesRepresentative::EMAIL),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(Status::class, [
                        Status::ACTIVE => 'Active',
                        Status::INACTIVE => 'Inactive',
                    ])
                )->bindToProperty(SalesRepresentative::STATUS),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(SalesRepresentative::CODE)->to(Field::create('code', 'Code')->string());
            $table->mapProperty(SalesRepresentative::NAME)->to(Field::create('name', 'Name')->string());
            $table->mapProperty(SalesRepresentative::PHONE)->to(Field::create('phone', 'Phone')->string());
            $table->mapProperty(SalesRepresentative::CELL)->to(Field::create('cell', 'Cell')->string());
            $table->mapProperty(SalesRepresentative::EMAIL)->to(Field::create('email', 'Email')->email());
            $table->mapProperty(SalesRepresentative::STATUS)->to(Field::create('status', 'Status')->enum(Status::class, [
                Status::ACTIVE => 'Active',
                Status::INACTIVE => 'Inactive',
            ]));


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}