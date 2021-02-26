<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales\Customers;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Sales\Customers\CustomersGroups;
use Dms\Common\Structure\Web\Persistence\HtmlMapper;

/**
 * The App\Domain\Entities\Sales\Customers\CustomersGroups entity mapper.
 */
class CustomersGroupsMapper extends EntityMapper
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
        $map->type(CustomersGroups::class);
        $map->toTable('customers_groups');

        $map->idToPrimaryKey('id');

        $map->property(CustomersGroups::CODE)->to('code')->asInt();

        $map->embedded(CustomersGroups::DESCRIPTION)
            ->using(new HtmlMapper('description'));

        $map->property(CustomersGroups::INACTIVE)->to('in_active')->asBool();


    }
}