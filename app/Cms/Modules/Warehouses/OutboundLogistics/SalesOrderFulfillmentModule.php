<?php declare(strict_types = 1);

namespace App\Cms\Modules\Warehouses\OutboundLogistics;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Warehouses\OutboundLogistics\ISalesOrderFulfillmentRepository;
use App\Domain\Entities\Warehouses\OutboundLogistics\SalesOrderFulfillment;
use Dms\Common\Structure\Field;
use App\Domain\Entities\Enums\CustomerStatusEnum;

/**
 * The sales-order-fulfillment module.
 */
class SalesOrderFulfillmentModule extends CrudModule
{


    public function __construct(ISalesOrderFulfillmentRepository $dataSource, IAuthSystem $authSystem)
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
        $module->name('sales-order-fulfillment');

        $module->labelObjects()->fromProperty(SalesOrderFulfillment::SALES_ORDER);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('sales_order', 'Sales Order')->string()->required()
                )->bindToProperty(SalesOrderFulfillment::SALES_ORDER),
                //
                $form->field(
                    Field::create('date', 'Date')->date()
                )->bindToProperty(SalesOrderFulfillment::DATE),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(CustomerStatusEnum::class, [
                        CustomerStatusEnum::ACTIVE => 'Active',
                        CustomerStatusEnum::INACTIVE => 'Inactive',
                        CustomerStatusEnum::POTENTIAL => 'Potential',
                        CustomerStatusEnum::RESTRICTED => 'Restricted',
                        CustomerStatusEnum::WARNED => 'Warned',
                    ])->required()
                )->bindToProperty(SalesOrderFulfillment::STATUS),
                //
                $form->field(
                    Field::create('part', 'Part')->string()
                )->bindToProperty(SalesOrderFulfillment::PART),
                //
                $form->field(
                    Field::create('so_qty', 'So Qty')->int()
                )->bindToProperty(SalesOrderFulfillment::SO_QTY),
                //
                $form->field(
                    Field::create('available', 'Available')->money()->required()
                )->bindToProperty(SalesOrderFulfillment::AVAILABLE),
                //
                $form->field(
                    Field::create('packed', 'Packed')->int()
                )->bindToProperty(SalesOrderFulfillment::PACKED),
                //
                $form->field(
                    Field::create('shipped', 'Shipped')->int()
                )->bindToProperty(SalesOrderFulfillment::SHIPPED),
                //
                $form->field(
                    Field::create('bo', 'Bo')->int()
                )->bindToProperty(SalesOrderFulfillment::BO),
                //
                $form->field(
                    Field::create('purchase_order', 'Purchase Order')->int()
                )->bindToProperty(SalesOrderFulfillment::PURCHASE_ORDER),
                //
                $form->field(
                    Field::create('date2', 'Date2')->string()
                )->bindToProperty(SalesOrderFulfillment::DATE2),
                //
                $form->field(
                    Field::create('status2', 'Status2')->enum(CustomerStatusEnum::class, [
                        CustomerStatusEnum::ACTIVE => 'Active',
                        CustomerStatusEnum::INACTIVE => 'Inactive',
                        CustomerStatusEnum::POTENTIAL => 'Potential',
                        CustomerStatusEnum::RESTRICTED => 'Restricted',
                        CustomerStatusEnum::WARNED => 'Warned',
                    ])
                )->bindToProperty(SalesOrderFulfillment::STATUS2),
                //
                $form->field(
                    Field::create('po_qty', 'Po Qty')->int()
                )->bindToProperty(SalesOrderFulfillment::PO_QTY),
                //
                $form->field(
                    Field::create('receiving', 'Receiving')->string()
                )->bindToProperty(SalesOrderFulfillment::RECEIVING),
                //
                $form->field(
                    Field::create('date3', 'Date3')->string()
                )->bindToProperty(SalesOrderFulfillment::DATE3),
                //
                $form->field(
                    Field::create('status3', 'Status3')->enum(CustomerStatusEnum::class, [
                        CustomerStatusEnum::ACTIVE => 'Active',
                        CustomerStatusEnum::INACTIVE => 'Inactive',
                        CustomerStatusEnum::POTENTIAL => 'Potential',
                        CustomerStatusEnum::RESTRICTED => 'Restricted',
                        CustomerStatusEnum::WARNED => 'Warned',
                    ])->required()
                )->bindToProperty(SalesOrderFulfillment::STATUS3),
                //
                $form->field(
                    Field::create('pr_qty', 'Pr Qty')->int()
                )->bindToProperty(SalesOrderFulfillment::PR_QTY),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(SalesOrderFulfillment::SALES_ORDER)->to(Field::create('sales_order', 'Sales Order')->string()->required());
            $table->mapProperty(SalesOrderFulfillment::DATE)->to(Field::create('date', 'Date')->date());
            $table->mapProperty(SalesOrderFulfillment::STATUS)->to(Field::create('status', 'Status')->enum(CustomerStatusEnum::class, [
                CustomerStatusEnum::ACTIVE => 'Active',
                CustomerStatusEnum::INACTIVE => 'Inactive',
                CustomerStatusEnum::POTENTIAL => 'Potential',
                CustomerStatusEnum::RESTRICTED => 'Restricted',
                CustomerStatusEnum::WARNED => 'Warned',
            ])->required());
            $table->mapProperty(SalesOrderFulfillment::PART)->to(Field::create('part', 'Part')->string());
            $table->mapProperty(SalesOrderFulfillment::SO_QTY)->to(Field::create('so_qty', 'So Qty')->int());
            $table->mapProperty(SalesOrderFulfillment::AVAILABLE)->to(Field::create('available', 'Available')->money()->required());
            $table->mapProperty(SalesOrderFulfillment::PACKED)->to(Field::create('packed', 'Packed')->int());
            $table->mapProperty(SalesOrderFulfillment::SHIPPED)->to(Field::create('shipped', 'Shipped')->int());
            $table->mapProperty(SalesOrderFulfillment::BO)->to(Field::create('bo', 'Bo')->int());
            $table->mapProperty(SalesOrderFulfillment::PURCHASE_ORDER)->to(Field::create('purchase_order', 'Purchase Order')->int());
            $table->mapProperty(SalesOrderFulfillment::DATE2)->to(Field::create('date2', 'Date2')->string());
            $table->mapProperty(SalesOrderFulfillment::STATUS2)->to(Field::create('status2', 'Status2')->enum(CustomerStatusEnum::class, [
                CustomerStatusEnum::ACTIVE => 'Active',
                CustomerStatusEnum::INACTIVE => 'Inactive',
                CustomerStatusEnum::POTENTIAL => 'Potential',
                CustomerStatusEnum::RESTRICTED => 'Restricted',
                CustomerStatusEnum::WARNED => 'Warned',
            ]));
            $table->mapProperty(SalesOrderFulfillment::PO_QTY)->to(Field::create('po_qty', 'Po Qty')->int());
            $table->mapProperty(SalesOrderFulfillment::RECEIVING)->to(Field::create('receiving', 'Receiving')->string());
            $table->mapProperty(SalesOrderFulfillment::DATE3)->to(Field::create('date3', 'Date3')->string());
            $table->mapProperty(SalesOrderFulfillment::STATUS3)->to(Field::create('status3', 'Status3')->enum(CustomerStatusEnum::class, [
                CustomerStatusEnum::ACTIVE => 'Active',
                CustomerStatusEnum::INACTIVE => 'Inactive',
                CustomerStatusEnum::POTENTIAL => 'Potential',
                CustomerStatusEnum::RESTRICTED => 'Restricted',
                CustomerStatusEnum::WARNED => 'Warned',
            ])->required());
            $table->mapProperty(SalesOrderFulfillment::PR_QTY)->to(Field::create('pr_qty', 'Pr Qty')->int());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}