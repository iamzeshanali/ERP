<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\ShippingMaintenance;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Warehouses\ShippingMaintenance\Shipments;
use Dms\Common\Structure\Web\Persistence\HtmlMapper;

/**
 * The App\Domain\Entities\Warehouses\ShippingMaintenance\Shipments entity mapper.
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

        $map->property(Shipments::CODE)->to('code')->asVarchar(255);

        $map->embedded(Shipments::DESCRIPTION)
            ->using(new HtmlMapper('description'));

        $map->property(Shipments::CARRIER_DETAIL)->to('carrier_detail')->asBool();


    }
}