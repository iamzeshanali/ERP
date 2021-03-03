<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Inventory;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Inventory\Group;


/**
 * The App\Domain\Entities\Inventory\Group entity mapper.
 */
class GroupMapper extends EntityMapper
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
        $map->type(Group::class);
        $map->toTable('groups');

        $map->idToPrimaryKey('id');

        $map->property(Group::CODE)->to('code')->asVarchar(255);

        $map->property(Group::DESCRIPTION)->to('description')->nullable()->asVarchar(255);

        $map->enum(Group::STATUS)->to('status')->usingValuesFromConstants();


    }
}