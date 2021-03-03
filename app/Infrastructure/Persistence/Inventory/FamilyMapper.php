<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Inventory;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Inventory\Family;


/**
 * The App\Domain\Entities\Inventory\Family entity mapper.
 */
class FamilyMapper extends EntityMapper
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
        $map->type(Family::class);
        $map->toTable('families');

        $map->idToPrimaryKey('id');

        $map->property(Family::CODE)->to('code')->asVarchar(255);

        $map->property(Family::DESCRIPTION)->to('description')->nullable()->asVarchar(255);

        $map->enum(Family::STATUS)->to('status')->usingValuesFromConstants();


    }
}