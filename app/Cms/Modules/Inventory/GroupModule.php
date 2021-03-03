<?php declare(strict_types = 1);

namespace App\Cms\Modules\Inventory;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Inventory\IGroupRepository;
use App\Domain\Entities\Inventory\Group;
use Dms\Common\Structure\Field;
use App\Domain\Entities\Enums\Status;

/**
 * The group module.
 */
class GroupModule extends CrudModule
{


    public function __construct(IGroupRepository $dataSource, IAuthSystem $authSystem)
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
        $module->name('group');

        $module->labelObjects()->fromProperty(Group::CODE);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->string()->required()
                )->bindToProperty(Group::CODE),
                //
                $form->field(
                    Field::create('description', 'Description')->string()
                )->bindToProperty(Group::DESCRIPTION),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(Status::class, [
                        Status::ACTIVE => 'Active',
                        Status::INACTIVE => 'Inactive',
                    ])
                )->bindToProperty(Group::STATUS),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(Group::CODE)->to(Field::create('code', 'Code')->string()->required());
            $table->mapProperty(Group::DESCRIPTION)->to(Field::create('description', 'Description')->string());
            $table->mapProperty(Group::STATUS)->to(Field::create('status', 'Status')->enum(Status::class, [
                Status::ACTIVE => 'Active',
                Status::INACTIVE => 'Inactive',
            ]));


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}