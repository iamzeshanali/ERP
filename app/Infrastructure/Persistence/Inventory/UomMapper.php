<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Inventory;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Inventory\Uom;


/**
 * The App\Domain\Entities\Inventory\Uom entity mapper.
 */
class UomMapper extends EntityMapper
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
        $map->type(Uom::class);
        $map->toTable('uoms');

        $map->idToPrimaryKey('id');

        $map->property(Uom::CODE)->to('code')->asVarchar(255);

        $map->property(Uom::QUANTITY)->to('quantity')->asVarchar(255);

        $map->enum(Uom::UNIT)->to('unit')->usingValuesFromConstants();

        $map->enum(Uom::STATUS)->to('status')->usingValuesFromConstants();


    }
}