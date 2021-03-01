<?php declare(strict_types = 1);

namespace App;


use App\Domain\Entities\Sales\Customers\Customers;
use App\Domain\Entities\Sales\Customers\CustomersGroups;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;

use App\Domain\Entities\Sales\SalesMaintenance\Branches;
use App\Domain\Entities\Sales\SalesMaintenance\PipelineMetrics;
use App\Domain\Entities\Sales\SalesMaintenance\TypeofSales;
use App\Domain\Entities\Sales\SalesTransactions\Quotation;
use App\Domain\Entities\Sales\SalesTransactions\SalesOrder;
use App\Domain\Entities\Warehouses\OutboundLogistics\CustomerReturn;
use App\Domain\Entities\Warehouses\OutboundLogistics\CustomerShipment;
use App\Domain\Entities\Warehouses\OutboundLogistics\PickingWorkArea;
use App\Domain\Entities\Warehouses\OutboundLogistics\SalesOrderFulfillment;
use App\Domain\Entities\Warehouses\ShippingMaintenance\CarriersAccounts;
use App\Domain\Entities\Warehouses\ShippingMaintenance\ShipmentList;
use App\Domain\Entities\Warehouses\ShippingMaintenance\Shipments;
use App\Domain\Entities\Warehouses\Warehouses;
use App\Infrastructure\Persistence\Sales\Customers\CustomersGroupsMapper;
use App\Infrastructure\Persistence\Sales\Customers\CustomersMapper;
use App\Infrastructure\Persistence\Sales\Customers\SalesRepresentativeMapper;

use App\Infrastructure\Persistence\Sales\SalesMaintenance\BranchesMapper;
use App\Infrastructure\Persistence\Sales\SalesMaintenance\PipelineMetricsMapper;
use App\Infrastructure\Persistence\Sales\SalesMaintenance\TypeofSalesMapper;
use App\Infrastructure\Persistence\Sales\SalesTransactions\QuotationMapper;
use App\Infrastructure\Persistence\Sales\SalesTransactions\SalesOrderMapper;
use App\Infrastructure\Persistence\Warehouses\OutboundLogistics\CustomerReturnMapper;
use App\Infrastructure\Persistence\Warehouses\OutboundLogistics\CustomerShipmentMapper;
use App\Infrastructure\Persistence\Warehouses\OutboundLogistics\PickingWorkAreaMapper;
use App\Infrastructure\Persistence\Warehouses\OutboundLogistics\SalesOrderFulfillmentMapper;
use App\Infrastructure\Persistence\Warehouses\ShippingMaintenance\CarriersAccountsMapper;
use App\Infrastructure\Persistence\Warehouses\ShippingMaintenance\ShipmentListMapper;
use App\Infrastructure\Persistence\Warehouses\ShippingMaintenance\ShipmentsMapper;
use App\Infrastructure\Persistence\Warehouses\WarehousesMapper;
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
            /*Warehouses*/
            Warehouses::class => WarehousesMapper::class,
                /*Shipping Maintenance*/
                Shipments::class => ShipmentsMapper::class,
                CarriersAccounts::class => CarriersAccountsMapper::class,
                ShipmentList::class => ShipmentListMapper::class,
                /*Outbound Logistics*/
                PickingWorkArea::class => PickingWorkAreaMapper::class,
                CustomerShipment::class => CustomerShipmentMapper::class,
                CustomerReturn::class => CustomerReturnMapper::class,
                SalesOrderFulfillment::class => SalesOrderFulfillmentMapper::class,


            /*Sales*/
                /*Customers*/
                SalesRepresentative::class => SalesRepresentativeMapper::class,
                CustomersGroups::class => CustomersGroupsMapper::class,
                Customers::class => CustomersMapper::class,
                /*SalesMaintenance*/
                Branches::class => BranchesMapper::class,
                PipelineMetrics::class => PipelineMetricsMapper::class,
                TypeofSales::class => TypeofSalesMapper::class,
                /*SalesTransactions*/
                Quotation::class => QuotationMapper::class,
                SalesOrder::class => SalesOrderMapper::class

        ]);
    }
}
