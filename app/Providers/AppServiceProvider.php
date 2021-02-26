<?php

namespace App\Providers;

use App\AppCms;
use App\AppOrm;
use App\Domain\Services\Persistence\Sales\Customers\ICustomersGroupsRepository;
use App\Domain\Services\Persistence\Sales\Customers\ICustomersRepository;
use App\Domain\Services\Persistence\Sales\Customers\ISalesRepresentativeRepository;
use App\Domain\Services\Persistence\Warehouses\IWarehouseRepository;
use App\Infrastructure\Persistence\Sales\Customers\DbCustomersGroupsRepository;
use App\Infrastructure\Persistence\Sales\Customers\DbCustomersRepository;
use App\Infrastructure\Persistence\Sales\Customers\DbSalesRepresentativeRepository;
use App\Infrastructure\Persistence\Warehouses\DbWarehouseRepository;
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

        $this->app->singleton(IWarehouseRepository::class, DbWarehouseRepository::class);
        $this->app->singleton(ISalesRepresentativeRepository::class, DbSalesRepresentativeRepository::class);
        $this->app->singleton(ICustomersGroupsRepository::class, DbCustomersGroupsRepository::class);
        $this->app->singleton(ICustomersRepository::class, DbCustomersRepository::class);
//        $this->app->singleton(IShipmentsRepository::class, DbShipmentsRepository::class);
//        $this->app->singleton(IShipmentListRepository::class, DbShipmentListRepository::class);
//        $this->app->singleton(ICarriersAccountsRepository::class, DbCarriersAccountsRepository::class);
    }
}
