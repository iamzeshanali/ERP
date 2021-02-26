<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales\SalesMaintenance;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Sales\SalesMaintenance\TypeofSales;
use Dms\Common\Structure\Web\Persistence\HtmlMapper;

/**
 * The App\Domain\Entities\Sales\SalesMaintenance\TypeofSales entity mapper.
 */
class TypeofSalesMapper extends EntityMapper
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
        $map->type(TypeofSales::class);
        $map->toTable('typeof_sales');

        $map->idToPrimaryKey('id');

        $map->property(TypeofSales::CODE)->to('code')->asInt();

        $map->embedded(TypeofSales::DESCRIPTION)
            ->using(new HtmlMapper('description'));

        $map->property(TypeofSales::INACTIVE)->to('in_active')->asBool();


    }
}