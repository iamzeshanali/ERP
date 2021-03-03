<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Financial;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Financial\PurchaseOrder;
use App\Domain\Entities\Sales\PreferredVendor;
use Dms\Common\Structure\DateTime\Persistence\DateMapper;
use App\Domain\Entities\Financial\PaymentTerms;
use App\Domain\Entities\Warehouse\Shipments;
use App\Domain\Entities\Financial\PurchaseOrderDetail;
use App\Domain\Entities\Financial\PurchaseOrderReceiving;

/**
 * The App\Domain\Entities\Financial\PurchaseOrder entity mapper.
 */
class PurchaseOrderMapper extends EntityMapper
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
        $map->type(PurchaseOrder::class);
        $map->toTable('purchase_orders');

        $map->idToPrimaryKey('id');

        $map->column('preferred_vendor_id')->asUnsignedInt();
        $map->relation(PurchaseOrder::VENDOR)
            ->to(PreferredVendor::class)
            ->manyToOne()
            ->withRelatedIdAs('preferred_vendor_id');

        $map->embedded(PurchaseOrder::DATE)
            ->withIssetColumn('date')
            ->using(new DateMapper('date'));

        $map->property(PurchaseOrder::DOCUMENT_NUMBER)->to('document_number')->nullable()->asVarchar(255);

        $map->property(PurchaseOrder::INVOICE_NUMBER)->to('invoice_number')->nullable()->asVarchar(255);

        $map->enum(PurchaseOrder::STATUS)->to('status')->usingValuesFromConstants();

        $map->column('payment_term_id')->asUnsignedInt();
        $map->relation(PurchaseOrder::PAYMENT_TERM)
            ->to(PaymentTerms::class)
            ->manyToOne()
            ->withRelatedIdAs('payment_term_id');

        $map->property(PurchaseOrder::TOTAL)->to('total')->nullable()->asVarchar(255);

        $map->property(PurchaseOrder::DISCOUNT)->to('discount')->nullable()->asVarchar(255);

        $map->property(PurchaseOrder::DISCOUNT_TYPE)->to('discount_type')->nullable()->asVarchar(255);

        $map->property(PurchaseOrder::TOTAL_AFTER_DISCOUNT)->to('total_after_discount')->nullable()->asVarchar(255);

        $map->property(PurchaseOrder::FINAL_PRICE)->to('final_price')->nullable()->asVarchar(255);

        $map->property(PurchaseOrder::SHIPPING_ADDRESS_LINE_1)->to('shipping_address_line1')->nullable()->asVarchar(255);

        $map->property(PurchaseOrder::SHIPPING_ADDRESS_LINE_2)->to('shipping_address_line2')->nullable()->asVarchar(255);

        $map->property(PurchaseOrder::SHIPPING_STATE)->to('shipping_state')->nullable()->asVarchar(255);

        $map->property(PurchaseOrder::SHIPPING_ZIP)->to('shipping_zip')->nullable()->asVarchar(255);

        $map->property(PurchaseOrder::SHIPPING_CITY)->to('shipping_city')->nullable()->asVarchar(255);

        $map->property(PurchaseOrder::SHIPPING_COUNTRY)->to('shipping_country')->nullable()->asVarchar(255);

        $map->column('shipping_code_id')->asUnsignedInt();
        $map->relation(PurchaseOrder::SHIPPING_CODE)
            ->to(Shipments::class)
            ->manyToOne()
            ->withRelatedIdAs('shipping_code_id');

        $map->relation(PurchaseOrder::PURCHASE_ORDER_DETAILS)
            ->to(PurchaseOrderDetail::class)
            ->toMany()
            ->identifying()
            ->withBidirectionalRelation(PurchaseOrderDetail::PURCHASE_ORDER)
            ->withParentIdAs('purchase_order_detail_id');

        $map->relation(PurchaseOrder::PURCHASE_ORDER_RECEIVING)
            ->to(PurchaseOrderReceiving::class)
            ->toMany()
            ->identifying()
            ->withBidirectionalRelation(PurchaseOrderReceiving::PURCHASE_ORDER)
            ->withParentIdAs('purchase_order_receiving_id');


    }
}
