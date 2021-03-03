<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Financial;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Financial\SalesInvoiceDetail;
use App\Domain\Entities\Sales\Product;
use Dms\Common\Structure\DateTime\Persistence\DateMapper;
use App\Domain\Entities\Sales\Brands;
use App\Domain\Entities\Financial\SalesInvoice;

/**
 * The App\Domain\Entities\Financial\SalesInvoiceDetail entity mapper.
 */
class SalesInvoiceDetailMapper extends EntityMapper
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
        $map->type(SalesInvoiceDetail::class);
        $map->toTable('sales_invoice_details');

        $map->idToPrimaryKey('id');

        $map->column('product_id')->asUnsignedInt();
        $map->relation(SalesInvoiceDetail::PRODUCT)
            ->to(Product::class)
            ->manyToOne()
            ->withRelatedIdAs('product_id');


        $map->property(SalesInvoiceDetail::QUANTITY)->to('quantity')->nullable()->asVarchar(255);

        $map->property(SalesInvoiceDetail::PRICE)->to('price')->nullable()->asVarchar(255);

        $map->property('availability')->to('availability')->nullable()->asVarchar(255);

        $map->embedded(SalesInvoiceDetail::DUE_DATE)
            ->using(new DateMapper('due_date'));

        $map->property(SalesInvoiceDetail::DISCOUNT)->to('discount')->nullable()->asVarchar(255);

        $map->property(SalesInvoiceDetail::DISCOUNT_TYPE)->to('discount_type')->nullable()->asVarchar(255);

        $map->property(SalesInvoiceDetail::TOTAL)->to('total')->nullable()->asVarchar(255);

        $map->column('brand_id')->asUnsignedInt();
        $map->relation(SalesInvoiceDetail::BRAND)
            ->to(Brands::class)
            ->manyToOne()
            ->withRelatedIdAs('brand_id');

        $map->column('sales_invoice_id')->asUnsignedInt();
        $map->relation(SalesInvoiceDetail::SALES_INVOICE)
            ->to(SalesInvoice::class)
            ->manyToOne()
            ->withBidirectionalRelation(SalesInvoice::SALES_INVOICE_DETAIL)
            ->withRelatedIdAs('sales_invoice_id');


    }
}