<?php declare(strict_types = 1);

namespace App\Cms\Modules\Warehouse;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Warehouse\IWarehouseRepository;
use App\Domain\Entities\Warehouse\Warehouse;
use Dms\Common\Structure\Field;
use App\Domain\Entities\Enums\Status;

/**
 * The warehouse module.
 */
class WarehouseModule extends CrudModule
{


    public function __construct(IWarehouseRepository $dataSource, IAuthSystem $authSystem)
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
        $module->name('warehouse');

        $module->labelObjects()->fromProperty(Warehouse::CODE);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->string()
                )->bindToProperty(Warehouse::CODE),
                //
                $form->field(
                    Field::create('description', 'Description')->html()
                )->bindToProperty(Warehouse::DESCRIPTION),
                //
                $form->field(
                    Field::create('address1', 'Address1')->string()
                )->bindToProperty(Warehouse::ADDRESS1),
                //
                $form->field(
                    Field::create('address2', 'Address2')->string()
                )->bindToProperty(Warehouse::ADDRESS2),
                //
                $form->field(
                    Field::create('city', 'City')->string()
                )->bindToProperty(Warehouse::CITY),
                //
                $form->field(
                    Field::create('state', 'State')->string()
                )->bindToProperty(Warehouse::STATE),
                //
                $form->field(
                    Field::create('country', 'Country')->string()
                )->bindToProperty(Warehouse::COUNTRY),
                //
                $form->field(
                    Field::create('zip', 'Zip')->string()
                )->bindToProperty(Warehouse::ZIP),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(Status::class, [
                        Status::ACTIVE => 'Active',
                        Status::INACTIVE => 'Inactive',
                    ])
                )->bindToProperty(Warehouse::STATUS),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(Warehouse::CODE)->to(Field::create('code', 'Code')->string());
            $table->mapProperty(Warehouse::DESCRIPTION)->to(Field::create('description', 'Description')->html());
            $table->mapProperty(Warehouse::ADDRESS1)->to(Field::create('address1', 'Address1')->string());
            $table->mapProperty(Warehouse::ADDRESS2)->to(Field::create('address2', 'Address2')->string());
            $table->mapProperty(Warehouse::CITY)->to(Field::create('city', 'City')->string());
            $table->mapProperty(Warehouse::STATE)->to(Field::create('state', 'State')->string());
            $table->mapProperty(Warehouse::COUNTRY)->to(Field::create('country', 'Country')->string());
            $table->mapProperty(Warehouse::ZIP)->to(Field::create('zip', 'Zip')->string());
            $table->mapProperty(Warehouse::STATUS)->to(Field::create('status', 'Status')->enum(Status::class, [
                Status::ACTIVE => 'Active',
                Status::INACTIVE => 'Inactive',
            ]));


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}