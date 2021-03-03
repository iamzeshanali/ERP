<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Financial;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Financial\PurchaseOrderReceiving;
use App\Domain\Entities\Sales\Product;
use Dms\Common\Structure\DateTime\Persistence\DateMapper;
use App\Domain\Entities\Sales\Brands;
use App\Domain\Entities\Financial\PurchaseOrder;

/**
 * The App\Domain\Entities\Financial\PurchaseOrderReceiving entity mapper.
 */
class PurchaseOrderReceivingMapper extends EntityMapper
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
        $map->type(PurchaseOrderReceiving::class);
        $map->toTable('purchase_order_receivings');

        $map->idToPrimaryKey('id');

        $map->column('product_id')->asUnsignedInt();
        $map->relation(PurchaseOrderReceiving::PRODUCT)
            ->to(Product::class)
            ->manyToOne()
            ->withRelatedIdAs('product_id');

        $map->property(PurchaseOrderReceiving::QUANTITY)->to('quantity')->nullable()->asVarchar(255);

        $map->embedded(PurchaseOrderReceiving::DUE_DATE)
            ->using(new DateMapper('due_date'));

        $map->property(PurchaseOrderReceiving::DISCOUNT)->to('discount')->nullable()->asVarchar(255);

        $map->property(PurchaseOrderReceiving::DISCOUNT_TYPE)->to('discount_type')->nullable()->asVarchar(255);

        $map->property(PurchaseOrderReceiving::TOTAL)->to('total')->nullable()->asVarchar(255);

        $map->column('brand_id')->asUnsignedInt();
        $map->relation(PurchaseOrderReceiving::BRAND)
            ->to(Brands::class)
            ->manyToOne()
            ->withRelatedIdAs('brand_id');

        $map->column('purchase_order_receiving_id')->asUnsignedInt();
        $map->relation(PurchaseOrderReceiving::PURCHASE_ORDER)
            ->to(PurchaseOrder::class)
            ->manyToOne()
            ->withBidirectionalRelation(PurchaseOrder::PURCHASE_ORDER_RECEIVING)
            ->withRelatedIdAs('purchase_order_receiving_id');


    }
}
