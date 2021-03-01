<?php declare(strict_types = 1);

namespace App\Cms\Modules\Warehouses\ShippingMaintenance;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Warehouses\ShippingMaintenance\IShipmentListRepository;
use App\Domain\Entities\Warehouses\ShippingMaintenance\ShipmentList;
use Dms\Common\Structure\Field;
use App\Domain\Services\Persistence\Sales\Customers\ICustomersRepository;
use App\Domain\Entities\Sales\Customers\Customers;
use App\Domain\Entities\Enums\CustomerStatusEnum;

/**
 * The shipment-list module.
 */
class ShipmentListModule extends CrudModule
{
    /**
     * @var ICustomersRepository
     */
    protected $customersRepository;


    public function __construct(IShipmentListRepository $dataSource, IAuthSystem $authSystem, ICustomersRepository $customersRepository)
    {
        $this->customersRepository = $customersRepository;
        parent::__construct($dataSource, $authSystem);
    }

    /**
     * Defines the structure of this module.
     *
     * @param CrudModuleDefinition $module
     */
    protected function defineCrudModule(CrudModuleDefinition $module)
    {
        $module->name('shipment-list');

        $module->labelObjects()->fromProperty(ShipmentList::DOCUMENT);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('document', 'Document')->string()->required()
                )->bindToProperty(ShipmentList::DOCUMENT),
                //
                $form->field(
                    Field::create('date', 'Date')->date()
                )->bindToProperty(ShipmentList::DATE),
                //
                $form->field(
                    Field::create('customer', 'Customer')
                        ->entityFrom($this->customersRepository)
                        ->required()
                        ->labelledBy(Customers::FIRST_NAME)
                )->bindToProperty(ShipmentList::CUSTOMER),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(CustomerStatusEnum::class, [
                        CustomerStatusEnum::ACTIVE => 'Active',
                        CustomerStatusEnum::INACTIVE => 'Inactive',
                        CustomerStatusEnum::POTENTIAL => 'Potential',
                        CustomerStatusEnum::RESTRICTED => 'Restricted',
                        CustomerStatusEnum::WARNED => 'Warned',
                    ])->required()
                )->bindToProperty(ShipmentList::STATUS),
                //
                $form->field(
                    Field::create('rate', 'Rate')->money()
                )->bindToProperty(ShipmentList::RATE),
                //
                $form->field(
                    Field::create('tracking_numbers', 'Tracking Numbers')->string()
                )->bindToProperty(ShipmentList::TRACKING_NUMBERS),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(ShipmentList::DOCUMENT)->to(Field::create('document', 'Document')->string()->required());
            $table->mapProperty(ShipmentList::DATE)->to(Field::create('date', 'Date')->date());
            $table->mapProperty(ShipmentList::CUSTOMER)->to(Field::create('customer', 'Customer')
                ->entityFrom($this->customersRepository)
                ->required()
                ->labelledBy(Customers::FIRST_NAME));
            $table->mapProperty(ShipmentList::STATUS)->to(Field::create('status', 'Status')->enum(CustomerStatusEnum::class, [
                CustomerStatusEnum::ACTIVE => 'Active',
                CustomerStatusEnum::INACTIVE => 'Inactive',
                CustomerStatusEnum::POTENTIAL => 'Potential',
                CustomerStatusEnum::RESTRICTED => 'Restricted',
                CustomerStatusEnum::WARNED => 'Warned',
            ])->required());
            $table->mapProperty(ShipmentList::RATE)->to(Field::create('rate', 'Rate')->money());
            $table->mapProperty(ShipmentList::TRACKING_NUMBERS)->to(Field::create('tracking_numbers', 'Tracking Numbers')->string());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}