<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Financial;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Financial\PurchaseOrderDetail;
use App\Domain\Entities\Sales\Product;
use Dms\Common\Structure\DateTime\Persistence\DateMapper;
use App\Domain\Entities\Sales\Brands;
use App\Domain\Entities\Financial\PurchaseOrder;

/**
 * The App\Domain\Entities\Financial\PurchaseOrderDetail entity mapper.
 */
class PurchaseOrderDetailMapper extends EntityMapper
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
        $map->type(PurchaseOrderDetail::class);
        $map->toTable('purchase_order_details');

        $map->idToPrimaryKey('id');

        $map->column('product_id')->asUnsignedInt();
        $map->relation(PurchaseOrderDetail::PRODUCT)
            ->to(Product::class)
            ->manyToOne()
            ->withRelatedIdAs('product_id');

        $map->property(PurchaseOrderDetail::QUANTITY)->to('quantity')->nullable()->asVarchar(255);

        $map->property(PurchaseOrderDetail::UNIT_PRICE)->to('unit_price')->nullable()->asVarchar(255);

        $map->embedded(PurchaseOrderDetail::DUE_DATE)
            ->using(new DateMapper('due_date'));

        $map->property(PurchaseOrderDetail::DISCOUNT)->to('discount')->nullable()->asVarchar(255);

        $map->property(PurchaseOrderDetail::DISCOUNT_TYPE)->to('discount_type')->nullable()->asVarchar(255);

        $map->property(PurchaseOrderDetail::TOTAL)->to('total')->nullable()->asVarchar(255);

        $map->column('brand_id')->asUnsignedInt();
        $map->relation(PurchaseOrderDetail::BRAND)
            ->to(Brands::class)
            ->manyToOne()
            ->withRelatedIdAs('brand_id');

        $map->column('purchase_order_detail_id')->asUnsignedInt();
        $map->relation(PurchaseOrderDetail::PURCHASE_ORDER)
            ->to(PurchaseOrder::class)
            ->manyToOne()
            ->withBidirectionalRelation(PurchaseOrder::PURCHASE_ORDER_DETAILS)
            ->withRelatedIdAs('purchase_order_detail_id');


    }
}
