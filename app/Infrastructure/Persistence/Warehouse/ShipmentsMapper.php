<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouse;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Warehouse\Shipments;
use Dms\Common\Structure\Web\Persistence\HtmlMapper;

/**
 * The App\Domain\Entities\Warehouse\Shipments entity mapper.
 */
class ShipmentsMapper extends EntityMapper
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
        $map->type(Shipments::class);
        $map->toTable('shipments');

        $map->idToPrimaryKey('id');

        $map->property(Shipments::SEASON)->to('season')->nullable()->asVarchar(255);

        $map->property(Shipments::SHIPMENT_CODE)->to('shipment_code')->nullable()->asVarchar(255);

        $map->embedded(Shipments::DESCRIPTION)
            ->withIssetColumn('description')
            ->using(new HtmlMapper('description'));


    }
}