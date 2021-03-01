<?php

namespace App\Providers;

use App\AppCms;
use App\AppOrm;
use App\Domain\Services\Persistence\Sales\Customers\ICustomersGroupsRepository;
use App\Domain\Services\Persistence\Sales\Customers\ICustomersRepository;
use App\Domain\Services\Persistence\Sales\Customers\ISalesRepresentativeRepository;
use App\Domain\Services\Persistence\Sales\SalesMaintenance\IBranchesRepository;
use App\Domain\Services\Persistence\Sales\SalesMaintenance\IPipelineMetricsRepository;
use App\Domain\Services\Persistence\Sales\SalesMaintenance\ITypeofSalesRepository;
use App\Domain\Services\Persistence\Sales\SalesTransactions\IQuotationRepository;
use App\Domain\Services\Persistence\Sales\SalesTransactions\ISalesOrderRepository;
use App\Domain\Services\Persistence\Warehouses\IWarehousesRepository;
use App\Domain\Services\Persistence\Warehouses\OutboundLogistics\ICustomerReturnRepository;
use App\Domain\Services\Persistence\Warehouses\OutboundLogistics\ICustomerShipmentRepository;
use App\Domain\Services\Persistence\Warehouses\OutboundLogistics\IPickingWorkAreaRepository;
use App\Domain\Services\Persistence\Warehouses\OutboundLogistics\ISalesOrderFulfillmentRepository;
use App\Domain\Services\Persistence\Warehouses\ShippingMaintenance\ICarriersAccountsRepository;
use App\Domain\Services\Persistence\Warehouses\ShippingMaintenance\IShipmentListRepository;
use App\Domain\Services\Persistence\Warehouses\ShippingMaintenance\IShipmentsRepository;
use App\Infrastructure\Persistence\Sales\Customers\DbCustomersGroupsRepository;
use App\Infrastructure\Persistence\Sales\Customers\DbCustomersRepository;
use App\Infrastructure\Persistence\Sales\Customers\DbSalesRepresentativeRepository;
use App\Infrastructure\Persistence\Sales\SalesMaintenance\DbBranchesRepository;
use App\Infrastructure\Persistence\Sales\SalesMaintenance\DbPipelineMetricsRepository;
use App\Infrastructure\Persistence\Sales\SalesMaintenance\DbTypeofSalesRepository;
use App\Infrastructure\Persistence\Sales\SalesTransactions\DbQuotationRepository;
use App\Infrastructure\Persistence\Sales\SalesTransactions\DbSalesOrderRepository;
use App\Infrastructure\Persistence\Warehouses\DbWarehousesRepository;
use App\Infrastructure\Persistence\Warehouses\OutboundLogistics\DbCustomerReturnRepository;
use App\Infrastructure\Persistence\Warehouses\OutboundLogistics\DbCustomerShipmentRepository;
use App\Infrastructure\Persistence\Warehouses\OutboundLogistics\DbPickingWorkAreaRepository;
use App\Infrastructure\Persistence\Warehouses\OutboundLogistics\DbSalesOrderFulfillmentRepository;
use App\Infrastructure\Persistence\Warehouses\ShippingMaintenance\DbCarriersAccountsRepository;
use App\Infrastructure\Persistence\Warehouses\ShippingMaintenance\DbShipmentListRepository;
use App\Infrastructure\Persistence\Warehouses\ShippingMaintenance\DbShipmentsRepository;
use Dms\Core\ICms;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IOrm::class, AppOrm::class);
        $this->app->singleton(ICms::class, AppCms::class);
        /*
         * Entity Related repositories Here
        */
        /*Warehouses*/
        $this->app->singleton(IWarehousesRepository::class, DbWarehousesRepository::class);
            /*ShippingMaintenance*/
            $this->app->singleton(IShipmentsRepository::class, DbShipmentsRepository::class);
            $this->app->singleton(ICarriersAccountsRepository::class, DbCarriersAccountsRepository::class);
            $this->app->singleton(IShipmentListRepository::class, DbShipmentListRepository::class);
            /*Outbound Logistics*/
            $this->app->singleton(IPickingWorkAreaRepository::class, DbPickingWorkAreaRepository::class);
            $this->app->singleton(ICustomerShipmentRepository::class, DbCustomerShipmentRepository::class);
            $this->app->singleton(ICustomerReturnRepository::class, DbCustomerReturnRepository::class);
            $this->app->singleton(ISalesOrderFulfillmentRepository::class, DbSalesOrderFulfillmentRepository::class);
        /*Sales*/
            /*Customers*/
            $this->app->singleton(ISalesRepresentativeRepository::class, DbSalesRepresentativeRepository::class);
            $this->app->singleton(ICustomersGroupsRepository::class, DbCustomersGroupsRepository::class);
            $this->app->singleton(ICustomersRepository::class, DbCustomersRepository::class);
            /*SalesMaintenance*/
            $this->app->singleton(IBranchesRepository::class, DbBranchesRepository::class);
            $this->app->singleton(IPipelineMetricsRepository::class, DbPipelineMetricsRepository::class);
            $this->app->singleton(ITypeofSalesRepository::class, DbTypeofSalesRepository::class);
            /*SalesTransactions*/
            $this->app->singleton(IQuotationRepository::class, DbQuotationRepository::class);
            $this->app->singleton(ISalesOrderRepository::class, DbSalesOrderRepository::class);
    }
}
