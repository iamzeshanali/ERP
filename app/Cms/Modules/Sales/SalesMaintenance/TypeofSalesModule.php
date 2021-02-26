<?php declare(strict_types = 1);

namespace App\Cms\Modules\Sales\SalesMaintenance;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Sales\SalesMaintenance\ITypeofSalesRepository;
use App\Domain\Entities\Sales\SalesMaintenance\TypeofSales;
use Dms\Common\Structure\Field;

/**
 * The typeof-sales module.
 */
class TypeofSalesModule extends CrudModule
{


    public function __construct(ITypeofSalesRepository $dataSource, IAuthSystem $authSystem)
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
        $module->name('typeof-sales');

        $module->labelObjects()->fromProperty(/* FIXME: */ TypeofSales::ID);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->int()->required()
                )->bindToProperty(TypeofSales::CODE),
                //
                $form->field(
                    Field::create('description', 'Description')->html()->required()
                )->bindToProperty(TypeofSales::DESCRIPTION),
                //
                $form->field(
                    Field::create('in_active', 'In Active')->bool()
                )->bindToProperty(TypeofSales::INACTIVE),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(TypeofSales::CODE)->to(Field::create('code', 'Code')->int()->required());
            $table->mapProperty(TypeofSales::DESCRIPTION)->to(Field::create('description', 'Description')->html()->required());
            $table->mapProperty(TypeofSales::INACTIVE)->to(Field::create('in_active', 'In Active')->bool());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}