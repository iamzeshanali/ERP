<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\ShippingMaintenance;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Warehouses\ShippingMaintenance\ShipmentList;
use Dms\Common\Structure\DateTime\Persistence\DateMapper;
use App\Domain\Entities\Sales\Customers\Customers;
use Dms\Common\Structure\Money\Persistence\MoneyMapper;

/**
 * The App\Domain\Entities\Warehouses\ShippingMaintenance\ShipmentList entity mapper.
 */
class ShipmentListMapper extends EntityMapper
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
        $map->type(ShipmentList::class);
        $map->toTable('shipment_lists');

        $map->idToPrimaryKey('id');

        $map->property(ShipmentList::DOCUMENT)->to('document')->asVarchar(255);

        $map->embedded(ShipmentList::DATE)
            ->withIssetColumn('date')
            ->using(new DateMapper('date'));

        $map->column('customer_id')->asUnsignedInt();

        $map->relation(ShipmentList::CUSTOMER)
            ->to(Customers::class)
            ->manyToOne()
            ->withRelatedIdAs('customer_id');

        $map->enum(ShipmentList::STATUS)->to('status')->usingValuesFromConstants();

        $map->embedded(ShipmentList::RATE)
            ->withIssetColumn('rate_amount')
            ->using(new MoneyMapper('rate_amount', 'rate_currency'));

        $map->property(ShipmentList::TRACKING_NUMBERS)->to('tracking_numbers')->nullable()->asVarchar(255);


    }
}
