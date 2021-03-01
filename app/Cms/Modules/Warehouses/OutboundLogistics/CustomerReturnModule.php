<?php declare(strict_types = 1);

namespace App\Cms\Modules\Warehouses\OutboundLogistics;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Warehouses\OutboundLogistics\ICustomerReturnRepository;
use App\Domain\Entities\Warehouses\OutboundLogistics\CustomerReturn;
use Dms\Common\Structure\Field;
use App\Domain\Services\Persistence\Sales\Customers\ICustomersRepository;
use App\Domain\Entities\Sales\Customers\Customers;
use App\Domain\Entities\Enums\CustomerStatusEnum;
use App\Domain\Services\Persistence\Sales\Customers\ISalesRepresentativeRepository;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;

/**
 * The customer-return module.
 */
class CustomerReturnModule extends CrudModule
{
    /**
     * @var ICustomersRepository
     */
    protected $customersRepository;

    /**
     * @var ISalesRepresentativeRepository
     */
    protected $salesRepresentativeRepository;


    public function __construct(ICustomerReturnRepository $dataSource, IAuthSystem $authSystem, ICustomersRepository $customersRepository, ISalesRepresentativeRepository $salesRepresentativeRepository)
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
        $module->name('customer-return');

        $module->labelObjects()->fromProperty(CustomerReturn::DOCUMENT);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('document', 'Document')->string()->required()
                )->bindToProperty(CustomerReturn::DOCUMENT),
                //
                $form->field(
                    Field::create('date', 'Date')->date()
                )->bindToProperty(CustomerReturn::DATE),
                //
                $form->field(
                    Field::create('customer', 'Customer')
                        ->entityFrom($this->customersRepository)
                        ->required()
                        ->labelledBy(Customers::FIRST_NAME)
                )->bindToProperty(CustomerReturn::CUSTOMER),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(CustomerStatusEnum::class, [
                        CustomerStatusEnum::ACTIVE => 'Active',
                        CustomerStatusEnum::INACTIVE => 'Inactive',
                        CustomerStatusEnum::POTENTIAL => 'Potential',
                        CustomerStatusEnum::RESTRICTED => 'Restricted',
                        CustomerStatusEnum::WARNED => 'Warned',
                    ])->required()
                )->bindToProperty(CustomerReturn::STATUS),
                //
                $form->field(
                    Field::create('sales_representative', 'Sales Representative')
                        ->entityFrom($this->salesRepresentativeRepository)
                        ->required()
                        ->labelledBy(SalesRepresentative::FIRST_NAME)
                )->bindToProperty(CustomerReturn::SALES_REPRESENTATIVE),
                //
                $form->field(
                    Field::create('assigned_to', 'Assigned To')->string()
                )->bindToProperty(CustomerReturn::ASSIGNED_TO),
                //
                $form->field(
                    Field::create('po_number', 'Po Number')->string()
                )->bindToProperty(CustomerReturn::PO_NUMBER),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(CustomerReturn::DOCUMENT)->to(Field::create('document', 'Document')->string()->required());
            $table->mapProperty(CustomerReturn::DATE)->to(Field::create('date', 'Date')->date());
            $table->mapProperty(CustomerReturn::CUSTOMER)->to(Field::create('customer', 'Customer')
                ->entityFrom($this->customersRepository)
                ->required()
                ->labelledBy(Customers::FIRST_NAME));
            $table->mapProperty(CustomerReturn::STATUS)->to(Field::create('status', 'Status')->enum(CustomerStatusEnum::class, [
                CustomerStatusEnum::ACTIVE => 'Active',
                CustomerStatusEnum::INACTIVE => 'Inactive',
                CustomerStatusEnum::POTENTIAL => 'Potential',
                CustomerStatusEnum::RESTRICTED => 'Restricted',
                CustomerStatusEnum::WARNED => 'Warned',
            ])->required());
            $table->mapProperty(CustomerReturn::SALES_REPRESENTATIVE)->to(Field::create('sales_representative', 'Sales Representative')
                ->entityFrom($this->salesRepresentativeRepository)
                ->required()
                ->labelledBy(SalesRepresentative::FIRST_NAME));
            $table->mapProperty(CustomerReturn::ASSIGNED_TO)->to(Field::create('assigned_to', 'Assigned To')->string());
            $table->mapProperty(CustomerReturn::PO_NUMBER)->to(Field::create('po_number', 'Po Number')->string());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}