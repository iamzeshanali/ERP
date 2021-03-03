<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Financial;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Financial\SalesInvoice;
use App\Domain\Entities\Sales\Customer;
use Dms\Common\Structure\DateTime\Persistence\DateMapper;
use App\Domain\Entities\Sales\SalesRepresentative;
use App\Domain\Entities\Warehouse\Shipments;
use App\Domain\Entities\Financial\PaymentTerms;
use App\Domain\Entities\Warehouse\Warehouse;
use App\Domain\Entities\Financial\SalesInvoiceDetail;

/**
 * The App\Domain\Entities\Financial\SalesInvoice entity mapper.
 */
class SalesInvoiceMapper extends EntityMapper
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
        $map->type(SalesInvoice::class);
        $map->toTable('sales_invoices');

        $map->idToPrimaryKey('id');

        $map->column('customer_id')->asUnsignedInt();
        $map->relation(SalesInvoice::CUSTOMER)
            ->to(Customer::class)
            ->manyToOne()
            ->withRelatedIdAs('customer_id');

        $map->embedded(SalesInvoice::DATE)
            ->using(new DateMapper('date'));

        $map->property(SalesInvoice::INVOICE_NUMBER)->to('invoice_number')->asVarchar(255);

        $map->enum(SalesInvoice::STATUS)->to('status')->usingValuesFromConstants();

        $map->property(SalesInvoice::SHIPPING_ADDRESS_LINE_1)->to('shipping_address_line1')->nullable()->asVarchar(255);

        $map->property(SalesInvoice::SHIPPING_ADDRESS_LINE_2)->to('shipping_address_line2')->nullable()->asVarchar(255);

        $map->property(SalesInvoice::SHIPPING_STATE)->to('shipping_state')->nullable()->asVarchar(255);

        $map->property(SalesInvoice::SHIPPING_ZIP)->to('shipping_zip')->nullable()->asVarchar(255);

        $map->property(SalesInvoice::SHIPPING_CITY)->to('shipping_city')->nullable()->asVarchar(255);

        $map->property(SalesInvoice::SHIPPING_COUNTRY)->to('shipping_country')->nullable()->asVarchar(255);

        $map->column('sales_representative_id')->asUnsignedInt();
        $map->relation(SalesInvoice::SALES_REP)
            ->to(SalesRepresentative::class)
            ->manyToOne()
            ->withRelatedIdAs('sales_representative_id');

        $map->column('shipping_code_id')->asUnsignedInt();
        $map->relation(SalesInvoice::SHIPPING_CODE)
            ->to(Shipments::class)
            ->manyToOne()
            ->withRelatedIdAs('shipping_code_id');

        // $map->column('assigned_id')->asUnsignedInt();
        // $map->relation(SalesInvoice::ASSIGNED)
        //     ->to(Admin::class)
        //     ->manyToOne()
        //     ->withRelatedIdAs('assigned_id');

        $map->column('payment_terms_id')->asUnsignedInt();
        $map->relation(SalesInvoice::PAYMENT_TERMS)
            ->to(PaymentTerms::class)
            ->manyToOne()
            ->withRelatedIdAs('payment_terms_id');

        $map->column('warehouse_id')->asUnsignedInt();
        $map->relation(SalesInvoice::WAREHOUSE)
            ->to(Warehouse::class)
            ->manyToOne()
            ->withRelatedIdAs('warehouse_id');

        $map->property(SalesInvoice::PROFIT_IN_PERCENT)->to('profit_in_percent')->nullable()->asVarchar(255);

        $map->property(SalesInvoice::PROFIT_IN_DOLLAR)->to('profit_in_dollar')->nullable()->asVarchar(255);

        $map->property(SalesInvoice::TOTAL)->to('total')->nullable()->asVarchar(255);

        $map->property(SalesInvoice::DISCOUNT_IN_PERCENT)->to('discount_in_percent')->nullable()->asVarchar(255);

        $map->property(SalesInvoice::DISCOUNT_IN_DOLLAR)->to('discount_in_dollar')->nullable()->asVarchar(255);

        $map->property(SalesInvoice::TOTAL_AFTER_DISCOUNT)->to('total_after_discount')->nullable()->asVarchar(255);

        $map->property(SalesInvoice::TOTAL_TAX)->to('total_tax')->nullable()->asVarchar(255);

        $map->property(SalesInvoice::FINAL_PRICE)->to('final_price')->nullable()->asVarchar(255);

        $map->relation(SalesInvoice::SALES_INVOICE_DETAIL)
            ->to(SalesInvoiceDetail::class)
            ->toMany()
            ->identifying()
            ->withBidirectionalRelation(SalesInvoiceDetail::SALES_INVOICE)
            ->withParentIdAs('sales_invoice_id');
    }
}