<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales\SalesTransactions;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Sales\SalesTransactions\SalesOrder;
use Dms\Common\Structure\DateTime\Persistence\DateMapper;
use App\Domain\Entities\Sales\Customers\Customers;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;
use Dms\Common\Structure\Money\Persistence\MoneyMapper;

/**
 * The App\Domain\Entities\Sales\SalesTransactions\SalesOrder entity mapper.
 */
class SalesOrderMapper extends EntityMapper
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
        $map->type(SalesOrder::class);
        $map->toTable('sales_orders');

        $map->idToPrimaryKey('id');

        $map->property(SalesOrder::DOCUMENT)->to('document')->asVarchar(255);

        $map->embedded(SalesOrder::DATE)
            ->withIssetColumn('date')
            ->using(new DateMapper('date'));

        $map->column('customer_id')->asUnsignedInt();
        $map->relation(SalesOrder::CUSTOMER)
            ->to(Customers::class)
            ->manyToOne()
            ->withRelatedIdAs('customer_id');

        $map->enum(SalesOrder::STATUS)->to('status')->usingValuesFromConstants();

        $map->column('sales_representative_id')->asUnsignedInt();
        $map->relation(SalesOrder::SALES_REPRESENTATIVE)
            ->to(SalesRepresentative::class)
            ->manyToOne()
            ->withRelatedIdAs('sales_representative_id');

        $map->property(SalesOrder::ASSIGNED_TO)->to('assigned_to')->nullable()->asVarchar(255);

        $map->property(SalesOrder::PO_NUMBER)->to('po_number')->nullable()->asVarchar(255);

        $map->embedded(SalesOrder::FINAL_PRICE)
            ->using(new MoneyMapper('final_price_amount', 'final_price_currency'));


    }
}
