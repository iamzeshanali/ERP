<?php declare(strict_types = 1);

namespace App\Cms\Modules\Sales\SalesMaintenance;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Sales\SalesMaintenance\IPipelineMetricsRepository;
use App\Domain\Entities\Sales\SalesMaintenance\PipelineMetrics;
use Dms\Common\Structure\Field;

/**
 * The pipeline-metrics module.
 */
class PipelineMetricsModule extends CrudModule
{


    public function __construct(IPipelineMetricsRepository $dataSource, IAuthSystem $authSystem)
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
        $module->name('pipeline-metrics');

        $module->labelObjects()->fromProperty(PipelineMetrics::PREFIX);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->int()->required()
                )->bindToProperty(PipelineMetrics::CODE),
                //
                $form->field(
                    Field::create('prefix', 'Prefix')->string()->required()
                )->bindToProperty(PipelineMetrics::PREFIX),
                //
                $form->field(
                    Field::create('description', 'Description')->html()->required()
                )->bindToProperty(PipelineMetrics::DESCRIPTION),
                //
                $form->field(
                    Field::create('in_active', 'In Active')->bool()
                )->bindToProperty(PipelineMetrics::INACTIVE),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(PipelineMetrics::CODE)->to(Field::create('code', 'Code')->int()->required());
            $table->mapProperty(PipelineMetrics::PREFIX)->to(Field::create('prefix', 'Prefix')->string()->required());
            $table->mapProperty(PipelineMetrics::DESCRIPTION)->to(Field::create('description', 'Description')->html()->required());
            $table->mapProperty(PipelineMetrics::INACTIVE)->to(Field::create('in_active', 'In Active')->bool());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}