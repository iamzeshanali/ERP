<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\OutboundLogistics;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Warehouses\OutboundLogistics\CustomerReturn;
use Dms\Common\Structure\DateTime\Persistence\DateMapper;
use App\Domain\Entities\Sales\Customers\Customers;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;

/**
 * The App\Domain\Entities\Warehouses\OutboundLogistics\CustomerReturn entity mapper.
 */
class CustomerReturnMapper extends EntityMapper
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
        $map->type(CustomerReturn::class);
        $map->toTable('customer_returns');

        $map->idToPrimaryKey('id');

        $map->property(CustomerReturn::DOCUMENT)->to('document')->asVarchar(255);

        $map->embedded(CustomerReturn::DATE)
            ->withIssetColumn('date')
            ->using(new DateMapper('date'));

        $map->column('customer_id')->asUnsignedInt();
        $map->relation(CustomerReturn::CUSTOMER)
            ->to(Customers::class)
            ->manyToOne()
            ->withRelatedIdAs('customer_id');

        $map->enum(CustomerReturn::STATUS)->to('status')->usingValuesFromConstants();

        $map->column('sales_representative_id')->asUnsignedInt();
        $map->relation(CustomerReturn::SALES_REPRESENTATIVE)
            ->to(SalesRepresentative::class)
            ->manyToOne()
            ->withRelatedIdAs('sales_representative_id');

        $map->property(CustomerReturn::ASSIGNED_TO)->to('assigned_to')->nullable()->asVarchar(255);

        $map->property(CustomerReturn::PO_NUMBER)->to('po_number')->nullable()->asVarchar(255);


    }
}
