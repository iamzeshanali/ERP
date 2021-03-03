<?php declare(strict_types = 1);

namespace App\Cms\Modules\Inventory;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Inventory\ICasePackRepository;
use App\Domain\Entities\Inventory\CasePack;
use Dms\Common\Structure\Field;
use App\Domain\Entities\Enums\Status;

/**
 * The case-pack module.
 */
class CasePackModule extends CrudModule
{


    public function __construct(ICasePackRepository $dataSource, IAuthSystem $authSystem)
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
        $module->name('case-pack');

        $module->labelObjects()->fromProperty(CasePack::CODE);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->string()
                )->bindToProperty(CasePack::CODE),
                //
                $form->field(
                    Field::create('description', 'Description')->html()
                )->bindToProperty(CasePack::DESCRIPTION),
                //
                $form->field(
                    Field::create('units_per_pack', 'Units Per Pack')->string()
                )->bindToProperty(CasePack::UNITS_PER_PACK),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(Status::class, [
                        Status::ACTIVE => 'Active',
                        Status::INACTIVE => 'Inactive',
                    ])
                )->bindToProperty(CasePack::STATUS),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(CasePack::CODE)->to(Field::create('code', 'Code')->string());
            $table->mapProperty(CasePack::DESCRIPTION)->to(Field::create('description', 'Description')->html());
            $table->mapProperty(CasePack::UNITS_PER_PACK)->to(Field::create('units_per_pack', 'Units Per Pack')->string());
            $table->mapProperty(CasePack::STATUS)->to(Field::create('status', 'Status')->enum(Status::class, [
                Status::ACTIVE => 'Active',
                Status::INACTIVE => 'Inactive',
            ]));


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}