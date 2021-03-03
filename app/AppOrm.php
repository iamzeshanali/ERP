<?php declare(strict_types = 1);

namespace App;


use App\Domain\Entities\Financial\PaymentTerms;
use App\Domain\Entities\Financial\PurchaseOrder;
use App\Domain\Entities\Financial\PurchaseOrderDetail;
use App\Domain\Entities\Financial\PurchaseOrderReceiving;
use App\Domain\Entities\Financial\Receipt;
use App\Domain\Entities\Financial\SalesInvoice;
use App\Domain\Entities\Financial\SalesInvoiceDetail;
use App\Domain\Entities\Financial\TaxClass;
use App\Domain\Entities\Inventory\CasePack;
use App\Domain\Entities\Inventory\Family;
use App\Domain\Entities\Inventory\Group;
use App\Domain\Entities\Inventory\Uom;
use App\Domain\Entities\Sales\Brands;
use App\Domain\Entities\Sales\Customer;
use App\Domain\Entities\Sales\PreferredVendor;
use App\Domain\Entities\Sales\Product;
use App\Domain\Entities\Sales\SalesRepresentative;
use App\Domain\Entities\Warehouse\Shipments;
use App\Domain\Entities\Warehouse\Warehouse;
use App\Infrastructure\Persistence\Financial\PaymentTermsMapper;
use App\Infrastructure\Persistence\Financial\PurchaseOrderDetailMapper;
use App\Infrastructure\Persistence\Financial\PurchaseOrderMapper;
use App\Infrastructure\Persistence\Financial\PurchaseOrderReceivingMapper;
use App\Infrastructure\Persistence\Financial\ReceiptMapper;
use App\Infrastructure\Persistence\Financial\SalesInvoiceDetailMapper;
use App\Infrastructure\Persistence\Financial\SalesInvoiceMapper;
use App\Infrastructure\Persistence\Financial\TaxClassMapper;
use App\Infrastructure\Persistence\Inventory\CasePackMapper;
use App\Infrastructure\Persistence\Inventory\FamilyMapper;
use App\Infrastructure\Persistence\Inventory\GroupMapper;
use App\Infrastructure\Persistence\Inventory\UomMapper;
use App\Infrastructure\Persistence\Sales\BrandsMapper;
use App\Infrastructure\Persistence\Sales\CustomerMapper;
use App\Infrastructure\Persistence\Sales\PreferredVendorMapper;
use App\Infrastructure\Persistence\Sales\ProductMapper;
use App\Infrastructure\Persistence\Sales\SalesRepresentativeMapper;
use App\Infrastructure\Persistence\Warehouse\ShipmentsMapper;
use App\Infrastructure\Persistence\Warehouse\WarehouseMapper;
use Dms\Core\Persistence\Db\Mapping\Definition\Orm\OrmDefinition;
use Dms\Core\Persistence\Db\Mapping\Orm;
use Dms\Web\Laravel\Persistence\Db\DmsOrm;

/**
 * The application's orm.
 */
class AppOrm extends Orm
{
    /**
     * Defines the object mappers registered in the orm.
     *
     * @param OrmDefinition $orm
     *
     * @return void
     */
    protected function define(OrmDefinition $orm)
    {
        $orm->enableLazyLoading();

        $orm->encompass(DmsOrm::inDefaultNamespace());

        // TODO: Register your mappers...
        $orm->entities([

            /*FINANCIAL*/
             PaymentTerms::class         => PaymentTermsMapper::class,
             TaxClass::class             => TaxClassMapper::class,
             PurchaseOrder::class => PurchaseOrderMapper::class,
             PurchaseOrderDetail::class => PurchaseOrderDetailMapper::class,
             PurchaseOrderReceiving::class => PurchaseOrderReceivingMapper::class,
             Receipt::class => ReceiptMapper::class,
             SalesInvoice::class => SalesInvoiceMapper::class,
             SalesInvoiceDetail::class => SalesInvoiceDetailMapper::class,

             /*SALES*/
             SalesRepresentative::class  => SalesRepresentativeMapper::class,
             Customer::class             => CustomerMapper::class,
             Brands::class               => BrandsMapper::class,
             PreferredVendor::class      => PreferredVendorMapper::class,
             Product::class              => ProductMapper::class,


             /*INVENTORY*/
             CasePack::class             => CasePackMapper::class,
             Family::class               => FamilyMapper::class,
             Group::class                => GroupMapper::class,
             Uom::class                  => UomMapper::class,

             /*WAREHOUSE*/
             Shipments::class => ShipmentsMapper::class,
             Warehouse::class => WarehouseMapper::class


        ]);
    }
}
