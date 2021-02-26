<?php declare(strict_types = 1);

namespace App\Cms\Modules\Warehouses;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Warehouses\IWarehousesRepository;
use App\Domain\Entities\Warehouses\Warehouses;
use Dms\Common\Structure\Field;

/**
 * The warehouses module.
 */
class WarehousesModule extends CrudModule
{


    public function __construct(IWarehousesRepository $dataSource, IAuthSystem $authSystem)
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
        $module->name('warehouses');

        $module->labelObjects()->fromProperty(Warehouses::CODE);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->string()->required()
                )->bindToProperty(Warehouses::CODE),
                //
                $form->field(
                    Field::create('description', 'Description')->html()->required()
                )->bindToProperty(Warehouses::DESCRIPTION),
                //
                $form->field(
                    Field::create('branch', 'Branch')->string()
                )->bindToProperty(Warehouses::BRANCH),
                //
                $form->field(
                    Field::create('address1', 'Address1')->string()->required()
                )->bindToProperty(Warehouses::ADDRESS_1),
                //
                $form->field(
                    Field::create('address2', 'Address2')->string()
                )->bindToProperty(Warehouses::ADDRESS_2),
                //
                $form->field(
                    Field::create('city', 'City')->string()->required()
                )->bindToProperty(Warehouses::CITY),
                //
                $form->field(
                    Field::create('state', 'State')->string()->required()
                )->bindToProperty(Warehouses::STATE),
                //
                $form->field(
                    Field::create('zip', 'Zip')->int()->required()
                )->bindToProperty(Warehouses::ZIP),
                //
                $form->field(
                    Field::create('country', 'Country')->string()
                )->bindToProperty(Warehouses::COUNTRY),
                //
                $form->field(
                    Field::create('inventory_valued', 'Inventory Valued')->bool()
                )->bindToProperty(Warehouses::INVENTORY_VALUED),
                //
                $form->field(
                    Field::create('include_mrp', 'Include Mrp')->bool()
                )->bindToProperty(Warehouses::INCLUDE_MRP),
                //
                $form->field(
                    Field::create('sales_warehouse', 'Sales Warehouse')->bool()
                )->bindToProperty(Warehouses::SALES_WAREHOUSE),
                //
                $form->field(
                    Field::create('balance', 'Balance')->money()->required()
                )->bindToProperty(Warehouses::BALANCE),
                //
                $form->field(
                    Field::create('in_active', 'In Active')->bool()
                )->bindToProperty(Warehouses::INACTIVE),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(Warehouses::CODE)->to(Field::create('code', 'Code')->string()->required());
            $table->mapProperty(Warehouses::DESCRIPTION)->to(Field::create('description', 'Description')->html()->required());
            $table->mapProperty(Warehouses::BRANCH)->to(Field::create('branch', 'Branch')->string());
            $table->mapProperty(Warehouses::ADDRESS_1)->to(Field::create('address1', 'Address1')->string()->required());
            $table->mapProperty(Warehouses::ADDRESS_2)->to(Field::create('address2', 'Address2')->string());
            $table->mapProperty(Warehouses::CITY)->to(Field::create('city', 'City')->string()->required());
            $table->mapProperty(Warehouses::STATE)->to(Field::create('state', 'State')->string()->required());
            $table->mapProperty(Warehouses::ZIP)->to(Field::create('zip', 'Zip')->int()->required());
            $table->mapProperty(Warehouses::COUNTRY)->to(Field::create('country', 'Country')->string());
            $table->mapProperty(Warehouses::INVENTORY_VALUED)->to(Field::create('inventory_valued', 'Inventory Valued')->bool());
            $table->mapProperty(Warehouses::INCLUDE_MRP)->to(Field::create('include_mrp', 'Include Mrp')->bool());
            $table->mapProperty(Warehouses::SALES_WAREHOUSE)->to(Field::create('sales_warehouse', 'Sales Warehouse')->bool());
            $table->mapProperty(Warehouses::BALANCE)->to(Field::create('balance', 'Balance')->money()->required());
            $table->mapProperty(Warehouses::INACTIVE)->to(Field::create('in_active', 'In Active')->bool());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}