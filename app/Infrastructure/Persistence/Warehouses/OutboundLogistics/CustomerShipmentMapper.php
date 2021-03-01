<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\OutboundLogistics;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Warehouses\OutboundLogistics\CustomerShipment;
use Dms\Common\Structure\DateTime\Persistence\DateMapper;
use App\Domain\Entities\Sales\Customers\Customers;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;

/**
 * The App\Domain\Entities\Warehouses\OutboundLogistics\CustomerShipment entity mapper.
 */
class CustomerShipmentMapper extends EntityMapper
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
        $map->type(CustomerShipment::class);
        $map->toTable('customer_shipments');

        $map->idToPrimaryKey('id');

        $map->property(CustomerShipment::DOCUMENT)->to('document')->asVarchar(255);


        $map->embedded(CustomerShipment::DATE)
            ->withIssetColumn('date')
            ->using(new DateMapper('date'));

        $map->column('customer_id')->asUnsignedInt();
        $map->relation(CustomerShipment::CUSTOMER)
            ->to(Customers::class)
            ->manyToOne()
            ->withRelatedIdAs('customer_id');

        $map->enum(CustomerShipment::STATUS)->to('status')->usingValuesFromConstants();

        $map->column('sales_representative_id')->asUnsignedInt();
        $map->relation(CustomerShipment::SALES_REPRESENTATIVE)
            ->to(SalesRepresentative::class)
            ->manyToOne()
            ->withRelatedIdAs('sales_representative_id');

        $map->property(CustomerShipment::ASSIGNED_TO)->to('assigned_to')->nullable()->asVarchar(255);

        $map->property(CustomerShipment::PO_NUMBER)->to('po_number')->nullable()->asVarchar(255);


    }
}
