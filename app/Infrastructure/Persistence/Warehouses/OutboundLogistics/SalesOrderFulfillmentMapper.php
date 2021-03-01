<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\OutboundLogistics;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Warehouses\OutboundLogistics\SalesOrderFulfillment;
use Dms\Common\Structure\DateTime\Persistence\DateMapper;
use Dms\Common\Structure\Money\Persistence\MoneyMapper;

/**
 * The App\Domain\Entities\Warehouses\OutboundLogistics\SalesOrderFulfillment entity mapper.
 */
class SalesOrderFulfillmentMapper extends EntityMapper
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
        $map->type(SalesOrderFulfillment::class);
        $map->toTable('sales_order_fulfillments');

        $map->idToPrimaryKey('id');

        $map->property(SalesOrderFulfillment::SALES_ORDER)->to('sales_order')->asVarchar(255);

        $map->embedded(SalesOrderFulfillment::DATE)
            ->withIssetColumn('date')
            ->using(new DateMapper('date'));

        $map->enum(SalesOrderFulfillment::STATUS)->to('status')->usingValuesFromConstants();

        $map->property(SalesOrderFulfillment::PART)->to('part')->nullable()->asVarchar(255);

        $map->property(SalesOrderFulfillment::SO_QTY)->to('so_qty')->nullable()->asInt();

        $map->embedded(SalesOrderFulfillment::AVAILABLE)
            ->using(new MoneyMapper('available_amount', 'available_currency'));

        $map->property(SalesOrderFulfillment::PACKED)->to('packed')->nullable()->asInt();

        $map->property(SalesOrderFulfillment::SHIPPED)->to('shipped')->nullable()->asInt();

        $map->property(SalesOrderFulfillment::BO)->to('bo')->nullable()->asInt();

        $map->property(SalesOrderFulfillment::PURCHASE_ORDER)->to('purchase_order')->nullable()->asInt();

        $map->property(SalesOrderFulfillment::DATE2)->to('date2')->nullable()->asVarchar(255);

        $map->enum(SalesOrderFulfillment::STATUS2)->to('status2')->usingValuesFromConstants();

        $map->property(SalesOrderFulfillment::PO_QTY)->to('po_qty')->nullable()->asInt();

        $map->property(SalesOrderFulfillment::RECEIVING)->to('receiving')->nullable()->asVarchar(255);

        $map->property(SalesOrderFulfillment::DATE3)->to('date3')->nullable()->asVarchar(255);

        $map->enum(SalesOrderFulfillment::STATUS3)->to('status3')->usingValuesFromConstants();

        $map->property(SalesOrderFulfillment::PR_QTY)->to('pr_qty')->nullable()->asInt();


    }
}