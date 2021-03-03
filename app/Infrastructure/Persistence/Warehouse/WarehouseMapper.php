<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouse;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Warehouse\Warehouse;
use Dms\Common\Structure\Web\Persistence\HtmlMapper;

/**
 * The App\Domain\Entities\Warehouse\Warehouse entity mapper.
 */
class WarehouseMapper extends EntityMapper
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
        $map->type(Warehouse::class);
        $map->toTable('warehouses');

        $map->idToPrimaryKey('id');

        $map->property(Warehouse::CODE)->to('code')->nullable()->asVarchar(255);

        $map->embedded(Warehouse::DESCRIPTION)
            ->withIssetColumn('description')
            ->using(new HtmlMapper('description'));

        $map->property(Warehouse::ADDRESS1)->to('address1')->nullable()->asVarchar(255);

        $map->property(Warehouse::ADDRESS2)->to('address2')->nullable()->asVarchar(255);

        $map->property(Warehouse::CITY)->to('city')->nullable()->asVarchar(255);

        $map->property(Warehouse::STATE)->to('state')->nullable()->asVarchar(255);

        $map->property(Warehouse::COUNTRY)->to('country')->nullable()->asVarchar(255);

        $map->property(Warehouse::ZIP)->to('zip')->nullable()->asVarchar(255);

        $map->enum(Warehouse::STATUS)->to('status')->usingValuesFromConstants();


    }
}