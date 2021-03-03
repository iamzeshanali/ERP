<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Inventory;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Inventory\CasePack;
use Dms\Common\Structure\Web\Persistence\HtmlMapper;

/**
 * The App\Domain\Entities\Inventory\CasePack entity mapper.
 */
class CasePackMapper extends EntityMapper
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
        $map->type(CasePack::class);
        $map->toTable('case_packs');

        $map->idToPrimaryKey('id');

        $map->property(CasePack::CODE)->to('code')->nullable()->asVarchar(255);

        $map->embedded(CasePack::DESCRIPTION)
            ->withIssetColumn('description')
            ->using(new HtmlMapper('description'));

        $map->property(CasePack::UNITS_PER_PACK)->to('units_per_pack')->nullable()->asVarchar(255);

        $map->enum(CasePack::STATUS)->to('status')->usingValuesFromConstants();


    }
}