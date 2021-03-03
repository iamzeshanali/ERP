<?php

namespace App\Providers;

use App\AppCms;
use App\AppOrm;
use App\Domain\Services\Persistence\Financial\IPaymentTermsRepository;
use App\Domain\Services\Persistence\Financial\IPurchaseOrderDetailRepository;
use App\Domain\Services\Persistence\Financial\IPurchaseOrderReceivingRepository;
use App\Domain\Services\Persistence\Financial\IPurchaseOrderRepository;
use App\Domain\Services\Persistence\Financial\IReceiptRepository;
use App\Domain\Services\Persistence\Financial\ISalesInvoiceDetailRepository;
use App\Domain\Services\Persistence\Financial\ISalesInvoiceRepository;
use App\Domain\Services\Persistence\Financial\ITaxClassRepository;
use App\Domain\Services\Persistence\Inventory\ICasePackRepository;
use App\Domain\Services\Persistence\Inventory\IFamilyRepository;
use App\Domain\Services\Persistence\Inventory\IGroupRepository;
use App\Domain\Services\Persistence\Inventory\IUomRepository;
use App\Domain\Services\Persistence\Sales\IBrandsRepository;
use App\Domain\Services\Persistence\Sales\ICustomerRepository;
use App\Domain\Services\Persistence\Sales\IPreferredVendorRepository;
use App\Domain\Services\Persistence\Sales\IProductRepository;
use App\Domain\Services\Persistence\Sales\ISalesRepresentativeRepository;
use App\Domain\Services\Persistence\Warehouse\IShipmentsRepository;
use App\Domain\Services\Persistence\Warehouse\IWarehouseRepository;
use App\Infrastructure\Persistence\Financial\DbPaymentTermsRepository;
use App\Infrastructure\Persistence\Financial\DbPurchaseOrderDetailRepository;
use App\Infrastructure\Persistence\Financial\DbPurchaseOrderReceivingRepository;
use App\Infrastructure\Persistence\Financial\DbPurchaseOrderRepository;
use App\Infrastructure\Persistence\Financial\DbReceiptRepository;
use App\Infrastructure\Persistence\Financial\DbSalesInvoiceDetailRepository;
use App\Infrastructure\Persistence\Financial\DbSalesInvoiceRepository;
use App\Infrastructure\Persistence\Financial\DbTaxClassRepository;
use App\Infrastructure\Persistence\Inventory\DbCasePackRepository;
use App\Infrastructure\Persistence\Inventory\DbFamilyRepository;
use App\Infrastructure\Persistence\Inventory\DbGroupRepository;
use App\Infrastructure\Persistence\Inventory\DbUomRepository;
use App\Infrastructure\Persistence\Sales\DbBrandsRepository;
use App\Infrastructure\Persistence\Sales\DbCustomerRepository;
use App\Infrastructure\Persistence\Sales\DbPreferredVendorRepository;
use App\Infrastructure\Persistence\Sales\DbProductRepository;
use App\Infrastructure\Persistence\Sales\DbSalesRepresentativeRepository;
use App\Infrastructure\Persistence\Warehouse\DbShipmentsRepository;
use App\Infrastructure\Persistence\Warehouse\DbWarehouseRepository;
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
        /*FINANCIAL*/
         $this->app->singleton(IPaymentTermsRepository::class, DbPaymentTermsRepository::class);
         $this->app->singleton(ITaxClassRepository::class, DbTaxClassRepository::class);
         $this->app->singleton(IPurchaseOrderRepository::class, DbPurchaseOrderRepository::class);
         $this->app->singleton(IPurchaseOrderDetailRepository::class, DbPurchaseOrderDetailRepository::class);
         $this->app->singleton(IPurchaseOrderReceivingRepository::class, DbPurchaseOrderReceivingRepository::class);
         $this->app->singleton(IReceiptRepository::class, DbReceiptRepository::class);
         $this->app->singleton(ISalesInvoiceRepository::class, DbSalesInvoiceRepository::class);
         $this->app->singleton(ISalesInvoiceDetailRepository::class, DbSalesInvoiceDetailRepository::class);

         /*SALES*/
         $this->app->singleton(ISalesRepresentativeRepository::class, DbSalesRepresentativeRepository::class);
         $this->app->singleton(ICustomerRepository::class, DbCustomerRepository::class);
         $this->app->singleton(IBrandsRepository::class, DbBrandsRepository::class);
         $this->app->singleton(IPreferredVendorRepository::class, DbPreferredVendorRepository::class);
         $this->app->singleton(IProductRepository::class, DbProductRepository::class);
         /*INVENTORY*/
         $this->app->singleton(ICasePackRepository::class, DbCasePackRepository::class);
         $this->app->singleton(IFamilyRepository::class, DbFamilyRepository::class);
         $this->app->singleton(IGroupRepository::class, DbGroupRepository::class);
         $this->app->singleton(IUomRepository::class, DbUomRepository::class);
         /*WAREHOUSE*/
         $this->app->singleton(IShipmentsRepository::class, DbShipmentsRepository::class);
         $this->app->singleton(IWarehouseRepository::class, DbWarehouseRepository::class);

    }

}
