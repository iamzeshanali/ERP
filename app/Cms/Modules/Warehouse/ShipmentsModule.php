<?php declare(strict_types = 1);

namespace App\Cms\Modules\Warehouse;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Warehouse\IShipmentsRepository;
use App\Domain\Entities\Warehouse\Shipments;
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

        $module->labelObjects()->fromProperty(Shipments::SEASON);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('season', 'Season')->string()
                )->bindToProperty(Shipments::SEASON),
                //
                $form->field(
                    Field::create('shipment_code', 'Shipment Code')->string()
                )->bindToProperty(Shipments::SHIPMENT_CODE),
                //
                $form->field(
                    Field::create('description', 'Description')->html()
                )->bindToProperty(Shipments::DESCRIPTION),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(Shipments::SEASON)->to(Field::create('season', 'Season')->string());
            $table->mapProperty(Shipments::SHIPMENT_CODE)->to(Field::create('shipment_code', 'Shipment Code')->string());
            $table->mapProperty(Shipments::DESCRIPTION)->to(Field::create('description', 'Description')->html());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}