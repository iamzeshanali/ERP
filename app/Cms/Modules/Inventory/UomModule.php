<?php declare(strict_types = 1);

namespace App\Cms\Modules\Inventory;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Inventory\IUomRepository;
use App\Domain\Entities\Inventory\Uom;
use Dms\Common\Structure\Field;
use App\Domain\Entities\Enums\Units;
use App\Domain\Entities\Enums\Status;

/**
 * The uom module.
 */
class UomModule extends CrudModule
{


    public function __construct(IUomRepository $dataSource, IAuthSystem $authSystem)
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
        $module->name('uom');

        $module->labelObjects()->fromProperty(Uom::CODE);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->string()->required()
                )->bindToProperty(Uom::CODE),
                //
                $form->field(
                    Field::create('quantity', 'Quantity')->string()->required()
                )->bindToProperty(Uom::QUANTITY),
                //
                $form->field(
                    Field::create('unit', 'Unit')->enum(Units::class, [
                        Units::OZ => 'Oz',
                        Units::ML => 'Ml',
                        Units::PINTS => 'Pints',
                        Units::QUARS => 'Quars',
                        Units::LITER => 'Liter',
                        Units::GALLON => 'Gallon',
                    ])->required()
                )->bindToProperty(Uom::UNIT),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(Status::class, [
                        Status::ACTIVE => 'Active',
                        Status::INACTIVE => 'Inactive',
                    ])->required()
                )->bindToProperty(Uom::STATUS),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(Uom::CODE)->to(Field::create('code', 'Code')->string()->required());
            $table->mapProperty(Uom::QUANTITY)->to(Field::create('quantity', 'Quantity')->string()->required());
            $table->mapProperty(Uom::UNIT)->to(Field::create('unit', 'Unit')->enum(Units::class, [
                Units::OZ => 'Oz',
                Units::ML => 'Ml',
                Units::PINTS => 'Pints',
                Units::QUARS => 'Quars',
                Units::LITER => 'Liter',
                Units::GALLON => 'Gallon',
            ])->required());
            $table->mapProperty(Uom::STATUS)->to(Field::create('status', 'Status')->enum(Status::class, [
                Status::ACTIVE => 'Active',
                Status::INACTIVE => 'Inactive',
            ])->required());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}