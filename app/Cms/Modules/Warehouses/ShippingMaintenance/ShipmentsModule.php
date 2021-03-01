<?php declare(strict_types = 1);

namespace App\Cms\Modules\Warehouses\ShippingMaintenance;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Warehouses\ShippingMaintenance\IShipmentsRepository;
use App\Domain\Entities\Warehouses\ShippingMaintenance\Shipments;
use Dms\Common\Structure\Field;

/**
 * The shipments module.
 */
class ShipmentsModule extends CrudModule
{


    public function __construct(IShipmentsRepository $dataSource, IAuthSystem $authSystem)
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
        $module->name('shipments');

        $module->labelObjects()->fromProperty(Shipments::CODE);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->string()->required()
                )->bindToProperty(Shipments::CODE),
                //
                $form->field(
                    Field::create('description', 'Description')->html()->required()
                )->bindToProperty(Shipments::DESCRIPTION),
                //
                $form->field(
                    Field::create('carrier_detail', 'Carrier Detail')->bool()
                )->bindToProperty(Shipments::CARRIER_DETAIL),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(Shipments::CODE)->to(Field::create('code', 'Code')->string()->required());
            $table->mapProperty(Shipments::DESCRIPTION)->to(Field::create('description', 'Description')->html()->required());
            $table->mapProperty(Shipments::CARRIER_DETAIL)->to(Field::create('carrier_detail', 'Carrier Detail')->bool());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}