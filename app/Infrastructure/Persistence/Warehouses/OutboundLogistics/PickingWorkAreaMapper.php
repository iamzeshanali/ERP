<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\OutboundLogistics;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Warehouses\OutboundLogistics\PickingWorkArea;
use Dms\Common\Structure\DateTime\Persistence\DateMapper;
use App\Domain\Entities\Sales\Customers\Customers;

/**
 * The App\Domain\Entities\Warehouses\OutboundLogistics\PickingWorkArea entity mapper.
 */
class PickingWorkAreaMapper extends EntityMapper
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
        $map->type(PickingWorkArea::class);
        $map->toTable('picking_work_areas');

        $map->idToPrimaryKey('id');

        $map->property(PickingWorkArea::DOCUMENT)->to('document')->asVarchar(255);

        $map->embedded(PickingWorkArea::DATE)
            ->withIssetColumn('date')
            ->using(new DateMapper('date'));

        $map->column('customer_id')->asUnsignedInt();
        $map->relation(PickingWorkArea::CUSTOMER)
            ->to(Customers::class)
            ->manyToOne()
            ->withRelatedIdAs('customer_id');

        $map->enum(PickingWorkArea::STATUS)->to('status')->usingValuesFromConstants();

        $map->property(PickingWorkArea::ASSIGNED_TO)->to('assigned_to')->nullable()->asVarchar(255);

        $map->property(PickingWorkArea::BRANCH)->to('branch')->nullable()->asVarchar(255);


    }
}
