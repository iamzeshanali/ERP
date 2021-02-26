<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Warehouses\Warehouses;
use Dms\Common\Structure\Web\Persistence\HtmlMapper;
use Dms\Common\Structure\Money\Persistence\MoneyMapper;

/**
 * The App\Domain\Entities\Warehouses\Warehouses entity mapper.
 */
class WarehousesMapper extends EntityMapper
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
        $map->type(Warehouses::class);
        $map->toTable('warehouses');

        $map->idToPrimaryKey('id');

        $map->property(Warehouses::CODE)->to('code')->asVarchar(255);

        $map->embedded(Warehouses::DESCRIPTION)
            ->using(new HtmlMapper('description'));

        $map->property(Warehouses::BRANCH)->to('branch')->nullable()->asVarchar(255);

        $map->property(Warehouses::ADDRESS_1)->to('address1')->asVarchar(255);

        $map->property(Warehouses::ADDRESS_2)->to('address2')->nullable()->asVarchar(255);

        $map->property(Warehouses::CITY)->to('city')->asVarchar(255);

        $map->property(Warehouses::STATE)->to('state')->asVarchar(255);

        $map->property(Warehouses::ZIP)->to('zip')->asInt();

        $map->property(Warehouses::COUNTRY)->to('country')->nullable()->asVarchar(255);

        $map->property(Warehouses::INVENTORY_VALUED)->to('inventory_valued')->asBool();

        $map->property(Warehouses::INCLUDE_MRP)->to('include_mrp')->asBool();

        $map->property(Warehouses::SALES_WAREHOUSE)->to('sales_warehouse')->asBool();

        $map->embedded(Warehouses::BALANCE)
            ->using(new MoneyMapper('balance_amount', 'balance_currency'));

        $map->property(Warehouses::INACTIVE)->to('in_active')->asBool();


    }
}