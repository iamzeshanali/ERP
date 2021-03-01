<?php declare(strict_types = 1);

namespace App\Cms;

use Dms\Core\Package\Definition\PackageDefinition;
use Dms\Core\Package\Package;
use App\Cms\Modules\Sales\Customers\CustomersModule;
use App\Cms\Modules\Sales\Customers\CustomersGroupsModule;
use App\Cms\Modules\Sales\Customers\SalesRepresentativeModule;

/**
 * The Customers package.
 */
class CustomersPackage extends Package
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
        $package->name('Customers');

        $package->metadata([
            'icon' => 'men',
        ]);

        $package->modules([
            'customers' => CustomersModule::class,
            'customers-groups' => CustomersGroupsModule::class,
            'sales-representative' => SalesRepresentativeModule::class,
        ]);
    }
}
