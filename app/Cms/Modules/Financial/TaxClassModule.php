<?php declare(strict_types = 1);

namespace App\Cms\Modules\Financial;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Financial\ITaxClassRepository;
use App\Domain\Entities\Financial\TaxClass;
use Dms\Common\Structure\Field;
use App\Domain\Entities\Enums\Status;

/**
 * The tax-class module.
 */
class TaxClassModule extends CrudModule
{


    public function __construct(ITaxClassRepository $dataSource, IAuthSystem $authSystem)
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
        $module->name('tax-class');

        $module->labelObjects()->fromProperty(TaxClass::CODE);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->string()
                )->bindToProperty(TaxClass::CODE),
                //
                $form->field(
                    Field::create('description', 'Description')->html()
                )->bindToProperty(TaxClass::DESCRIPTION),
                //
                $form->field(
                    Field::create('abv', 'Abv')->string()
                )->bindToProperty(TaxClass::ABV),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(Status::class, [
                        Status::ACTIVE => 'Active',
                        Status::INACTIVE => 'Inactive',
                    ])
                )->bindToProperty(TaxClass::STATUS),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(TaxClass::CODE)->to(Field::create('code', 'Code')->string());
            $table->mapProperty(TaxClass::DESCRIPTION)->to(Field::create('description', 'Description')->html());
            $table->mapProperty(TaxClass::ABV)->to(Field::create('abv', 'Abv')->string());
            $table->mapProperty(TaxClass::STATUS)->to(Field::create('status', 'Status')->enum(Status::class, [
                Status::ACTIVE => 'Active',
                Status::INACTIVE => 'Inactive',
            ]));


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}