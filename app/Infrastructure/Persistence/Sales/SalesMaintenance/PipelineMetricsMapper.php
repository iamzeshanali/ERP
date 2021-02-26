<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales\SalesMaintenance;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Sales\SalesMaintenance\PipelineMetrics;
use Dms\Common\Structure\Web\Persistence\HtmlMapper;

/**
 * The App\Domain\Entities\Sales\SalesMaintenance\PipelineMetrics entity mapper.
 */
class PipelineMetricsMapper extends EntityMapper
{
    /**
     * Defines the entity mapper
     *
     * @param MapperDefinition $map
     *
     * @return void
     */
    protected function define(MapperDefinition $map)
    {
        $map->type(PipelineMetrics::class);
        $map->toTable('pipeline_metrics');

        $map->idToPrimaryKey('id');

        $map->property(PipelineMetrics::CODE)->to('code')->asInt();

        $map->property(PipelineMetrics::PREFIX)->to('prefix')->asVarchar(255);

        $map->embedded(PipelineMetrics::DESCRIPTION)
            ->using(new HtmlMapper('description'));

        $map->property(PipelineMetrics::INACTIVE)->to('in_active')->asBool();


    }
}