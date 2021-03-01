<?php declare(strict_types = 1);

namespace App\Cms\Modules\Sales\SalesTransactions;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Sales\SalesTransactions\ISalesOrderRepository;
use App\Domain\Entities\Sales\SalesTransactions\SalesOrder;
use Dms\Common\Structure\Field;
use App\Domain\Services\Persistence\Sales\Customers\ICustomersRepository;
use App\Domain\Entities\Sales\Customers\Customers;
use App\Domain\Entities\Enums\CustomerStatusEnum;
use App\Domain\Services\Persistence\Sales\Customers\ISalesRepresentativeRepository;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;

/**
 * The sales-order module.
 */
class SalesOrderModule extends CrudModule
{
    /**
     * @var ICustomersRepository
     */
    protected $customersRepository;

    /**
     * @var ISalesRepresentativeRepository
     */
    protected $salesRepresentativeRepository;


    public function __construct(ISalesOrderRepository $dataSource, IAuthSystem $authSystem, ICustomersRepository $customersRepository, ISalesRepresentativeRepository $salesRepresentativeRepository)
    {
        $this->customersRepository = $customersRepository;
        $this->salesRepresentativeRepository = $salesRepresentativeRepository;
        parent::__construct($dataSource, $authSystem);
    }

    /**
     * Defines the structure of this module.
     *
     * @param CrudModuleDefinition $module
     */
    protected function defineCrudModule(CrudModuleDefinition $module)
    {
        $module->name('sales-order');

        $module->labelObjects()->fromProperty(SalesOrder::DOCUMENT);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('document', 'Document')->string()->required()
                )->bindToProperty(SalesOrder::DOCUMENT),
                //
                $form->field(
                    Field::create('date', 'Date')->date()
                )->bindToProperty(SalesOrder::DATE),
                //
                $form->field(
                    Field::create('customer', 'Customer')
                        ->entityFrom($this->customersRepository)
                        ->required()
                        ->labelledBy(Customers::FIRST_NAME)
                )->bindToProperty(SalesOrder::CUSTOMER),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(CustomerStatusEnum::class, [
                        CustomerStatusEnum::ACTIVE => 'Active',
                        CustomerStatusEnum::INACTIVE => 'Inactive',
                        CustomerStatusEnum::POTENTIAL => 'Potential',
                        CustomerStatusEnum::RESTRICTED => 'Restricted',
                        CustomerStatusEnum::WARNED => 'Warned',
                    ])->required()
                )->bindToProperty(SalesOrder::STATUS),
                //
                $form->field(
                    Field::create('sales_representative', 'Sales Representative')
                        ->entityFrom($this->salesRepresentativeRepository)
                        ->labelledBy(SalesRepresentative::FIRST_NAME)
                )->bindToProperty(SalesOrder::SALES_REPRESENTATIVE),
                //
                $form->field(
                    Field::create('assigned_to', 'Assigned To')->string()
                )->bindToProperty(SalesOrder::ASSIGNED_TO),
                //
                $form->field(
                    Field::create('po_number', 'Po Number')->string()
                )->bindToProperty(SalesOrder::PO_NUMBER),
                //
                $form->field(
                    Field::create('final_price', 'Final Price')->money()->required()
                )->bindToProperty(SalesOrder::FINAL_PRICE),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(SalesOrder::DOCUMENT)->to(Field::create('document', 'Document')->string()->required());
            $table->mapProperty(SalesOrder::DATE)->to(Field::create('date', 'Date')->date());
            $table->mapProperty(SalesOrder::CUSTOMER)->to(Field::create('customer', 'Customer')
                ->entityFrom($this->customersRepository)
                ->required()
                ->labelledBy(Customers::FIRST_NAME));
            $table->mapProperty(SalesOrder::STATUS)->to(Field::create('status', 'Status')->enum(CustomerStatusEnum::class, [
                CustomerStatusEnum::ACTIVE => 'Active',
                CustomerStatusEnum::INACTIVE => 'Inactive',
                CustomerStatusEnum::POTENTIAL => 'Potential',
                CustomerStatusEnum::RESTRICTED => 'Restricted',
                CustomerStatusEnum::WARNED => 'Warned',
            ])->required());
            $table->mapProperty(SalesOrder::SALES_REPRESENTATIVE)->to(Field::create('sales_representative', 'Sales Representative')
                ->entityFrom($this->salesRepresentativeRepository)
                ->labelledBy(SalesRepresentative::FIRST_NAME));
            $table->mapProperty(SalesOrder::ASSIGNED_TO)->to(Field::create('assigned_to', 'Assigned To')->string());
            $table->mapProperty(SalesOrder::PO_NUMBER)->to(Field::create('po_number', 'Po Number')->string());
            $table->mapProperty(SalesOrder::FINAL_PRICE)->to(Field::create('final_price', 'Final Price')->money()->required());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}