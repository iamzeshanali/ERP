<?php declare(strict_types = 1);

namespace App\Cms\Modules\Sales\SalesMaintenance;

use App\Domain\Services\Persistence\Sales\SalesMaintenance\IBranchesRepository;
use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Entities\Sales\SalesMaintenance\Branches;
use Dms\Common\Structure\Field;

/**
 * The branches module.
 */
class BranchesModule extends CrudModule
{


    public function __construct(IBranchesRepository $dataSource, IAuthSystem $authSystem)
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
        $module->name('branches');

        $module->labelObjects()->fromProperty(Branches::PREFIX);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->int()->required()
                )->bindToProperty(Branches::CODE),
                //
                $form->field(
                    Field::create('prefix', 'Prefix')->string()->required()
                )->bindToProperty(Branches::PREFIX),
                //
                $form->field(
                    Field::create('description', 'Description')->html()->required()
                )->bindToProperty(Branches::DESCRIPTION),
                //
                $form->field(
                    Field::create('in_active', 'In Active')->bool()
                )->bindToProperty(Branches::INACTIVE),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(Branches::CODE)->to(Field::create('code', 'Code')->int()->required());
            $table->mapProperty(Branches::PREFIX)->to(Field::create('prefix', 'Prefix')->string()->required());
            $table->mapProperty(Branches::DESCRIPTION)->to(Field::create('description', 'Description')->html()->required());
            $table->mapProperty(Branches::INACTIVE)->to(Field::create('in_active', 'In Active')->bool());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}
