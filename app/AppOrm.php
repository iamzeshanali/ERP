<?php declare(strict_types = 1);

namespace App;


use App\Domain\Entities\Sales\Customers\Customers;
use App\Domain\Entities\Sales\Customers\CustomersGroups;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;
use App\Domain\Entities\Sales\SalesMaintenance\Branches;
use App\Domain\Entities\Sales\SalesMaintenance\PipelineMetrics;
use App\Domain\Entities\Sales\SalesMaintenance\TypeofSales;
use App\Domain\Entities\Warehouses\Warehouses;
use App\Infrastructure\Persistence\Sales\Customers\CustomersGroupsMapper;
use App\Infrastructure\Persistence\Sales\Customers\CustomersMapper;
use App\Infrastructure\Persistence\Sales\Customers\SalesRepresentativeMapper;
use App\Infrastructure\Persistence\Sales\SalesMaintenance\BranchesMapper;
use App\Infrastructure\Persistence\Sales\SalesMaintenance\PipelineMetricsMapper;
use App\Infrastructure\Persistence\Sales\SalesMaintenance\TypeofSalesMapper;
use App\Infrastructure\Persistence\Warehouses\WarehouseMapper;
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
            Warehouses::class => WarehousesMapper::class,
            SalesRepresentative::class => SalesRepresentativeMapper::class,
            CustomersGroups::class => CustomersGroupsMapper::class,
            Customers::class => CustomersMapper::class,
            Branches::class => BranchesMapper::class,
            PipelineMetrics::class => PipelineMetricsMapper::class,
            TypeofSales::class => TypeofSalesMapper::class
        ]);
    }
}
