<?php declare(strict_types = 1);

namespace App\Cms;

use Dms\Core\Package\Definition\PackageDefinition;
use Dms\Core\Package\Package;
use App\Cms\Modules\Sales\Customers\CustomersModule;
use App\Cms\Modules\Sales\Customers\CustomersGroupsModule;
use App\Cms\Modules\Sales\Customers\SalesRepresentativeModule;
use App\Cms\Modules\Sales\SalesMaintenance\BranchesModule;
use App\Cms\Modules\Sales\SalesMaintenance\PipelineMetricsModule;
use App\Cms\Modules\Sales\SalesMaintenance\TypeofSalesModule;

/**
 * The Sales package.
 */
class SalesPackage extends Package
{
    /**
     * Defines the structure of this cms package.
     *
     * @param PackageDefinition $package
     *
     * @return void
     */
    protected function define(PackageDefinition $package)
    {
        $package->name('Sales');

        $package->metadata([
            'icon' => '',
        ]);

        $package->modules([
            'customers' => CustomersModule::class,
            'customers-groups' => CustomersGroupsModule::class,
            'sales-representative' => SalesRepresentativeModule::class,
            'branches' => BranchesModule::class,
            'pipeline-metrics' => PipelineMetricsModule::class,
            'typeof-sales' => TypeofSalesModule::class,
        ]);
    }
}