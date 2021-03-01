<?php declare(strict_types = 1);

namespace App\Cms\Modules\Warehouses\OutboundLogistics;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Warehouses\OutboundLogistics\IPickingWorkAreaRepository;
use App\Domain\Entities\Warehouses\OutboundLogistics\PickingWorkArea;
use Dms\Common\Structure\Field;
use App\Domain\Services\Persistence\Sales\Customers\ICustomersRepository;
use App\Domain\Entities\Sales\Customers\Customers;
use App\Domain\Entities\Enums\CustomerStatusEnum;

/**
 * The picking-work-area module.
 */
class PickingWorkAreaModule extends CrudModule
{
    /**
     * @var ICustomersRepository
     */
    protected $customersRepository;


    public function __construct(IPickingWorkAreaRepository $dataSource, IAuthSystem $authSystem, ICustomersRepository $customersRepository)
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
        $module->name('picking-work-area');

        $module->labelObjects()->fromProperty(PickingWorkArea::DOCUMENT);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('document', 'Document')->string()->required()
                )->bindToProperty(PickingWorkArea::DOCUMENT),
                //
                $form->field(
                    Field::create('date', 'Date')->date()
                )->bindToProperty(PickingWorkArea::DATE),
                //
                $form->field(
                    Field::create('customer', 'Customer')
                        ->entityFrom($this->customersRepository)
                        ->required()
                        ->labelledBy(Customers::FIRST_NAME)
                )->bindToProperty(PickingWorkArea::CUSTOMER),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(CustomerStatusEnum::class, [
                        CustomerStatusEnum::ACTIVE => 'Active',
                        CustomerStatusEnum::INACTIVE => 'Inactive',
                        CustomerStatusEnum::POTENTIAL => 'Potential',
                        CustomerStatusEnum::RESTRICTED => 'Restricted',
                        CustomerStatusEnum::WARNED => 'Warned',
                    ])->required()
                )->bindToProperty(PickingWorkArea::STATUS),
                //
                $form->field(
                    Field::create('assigned_to', 'Assigned To')->string()
                )->bindToProperty(PickingWorkArea::ASSIGNED_TO),
                //
                $form->field(
                    Field::create('branch', 'Branch')->string()
                )->bindToProperty(PickingWorkArea::BRANCH),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(PickingWorkArea::DOCUMENT)->to(Field::create('document', 'Document')->string()->required());
            $table->mapProperty(PickingWorkArea::DATE)->to(Field::create('date', 'Date')->date());
            $table->mapProperty(PickingWorkArea::CUSTOMER)->to(Field::create('customer', 'Customer')
                ->entityFrom($this->customersRepository)
                ->required()
                ->labelledBy(Customers::FIRST_NAME));
            $table->mapProperty(PickingWorkArea::STATUS)->to(Field::create('status', 'Status')->enum(CustomerStatusEnum::class, [
                CustomerStatusEnum::ACTIVE => 'Active',
                CustomerStatusEnum::INACTIVE => 'Inactive',
                CustomerStatusEnum::POTENTIAL => 'Potential',
                CustomerStatusEnum::RESTRICTED => 'Restricted',
                CustomerStatusEnum::WARNED => 'Warned',
            ])->required());
            $table->mapProperty(PickingWorkArea::ASSIGNED_TO)->to(Field::create('assigned_to', 'Assigned To')->string());
            $table->mapProperty(PickingWorkArea::BRANCH)->to(Field::create('branch', 'Branch')->string());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}