<?php declare(strict_types = 1);

namespace App\Cms\Modules\Sales\Customers;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Sales\Customers\ISalesRepresentativeRepository;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;
use Dms\Common\Structure\Field;

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
                    Field::create('code', 'Code')->string()->required()
                )->bindToProperty(SalesRepresentative::CODE),
                //
                $form->field(
                    Field::create('first_name', 'First Name')->string()->required()
                )->bindToProperty(SalesRepresentative::FIRST_NAME),
                //
                $form->field(
                    Field::create('last_name', 'Last Name')->string()
                )->bindToProperty(SalesRepresentative::LAST_NAME),
                //
                $form->field(
                    Field::create('commission', 'Commission')->decimal()->required()
                )->bindToProperty(SalesRepresentative::COMMISSION),
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
                    Field::create('in_active', 'In Active')->bool()
                )->bindToProperty(SalesRepresentative::INACTIVE),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(SalesRepresentative::CODE)->to(Field::create('code', 'Code')->string()->required());
            $table->mapProperty(SalesRepresentative::FIRST_NAME)->to(Field::create('first_name', 'First Name')->string()->required());
            $table->mapProperty(SalesRepresentative::LAST_NAME)->to(Field::create('last_name', 'Last Name')->string());
            $table->mapProperty(SalesRepresentative::COMMISSION)->to(Field::create('commission', 'Commission')->decimal()->required());
            $table->mapProperty(SalesRepresentative::PHONE)->to(Field::create('phone', 'Phone')->string());
            $table->mapProperty(SalesRepresentative::CELL)->to(Field::create('cell', 'Cell')->string());
            $table->mapProperty(SalesRepresentative::EMAIL)->to(Field::create('email', 'Email')->email());
            $table->mapProperty(SalesRepresentative::INACTIVE)->to(Field::create('in_active', 'In Active')->bool());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}