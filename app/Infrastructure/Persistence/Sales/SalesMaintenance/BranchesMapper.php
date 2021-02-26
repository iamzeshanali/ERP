<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales\SalesMaintenance;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Sales\SalesMaintenance\Branches;
use Dms\Common\Structure\Web\Persistence\HtmlMapper;

/**
 * The App\Domain\Entities\Sales\SalesMaintenance\Branches entity mapper.
 */
class BranchesMapper extends EntityMapper
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
        $map->type(Branches::class);
        $map->toTable('branches');

        $map->idToPrimaryKey('id');

        $map->property(Branches::CODE)->to('code')->asInt();

        $map->property(Branches::PREFIX)->to('prefix')->asVarchar(255);

        $map->embedded(Branches::DESCRIPTION)
            ->using(new HtmlMapper('description'));

        $map->property(Branches::INACTIVE)->to('in_active')->asBool();


    }
}