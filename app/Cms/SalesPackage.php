<?php declare(strict_types = 1);

namespace App\Cms;

use App\Cms\Modules\Sales\ProductModule;
use Dms\Core\Package\Definition\PackageDefinition;
use Dms\Core\Package\Package;
use App\Cms\Modules\Sales\BrandsModule;
use App\Cms\Modules\Sales\CustomerModule;
use App\Cms\Modules\Sales\PreferredVendorModule;
use App\Cms\Modules\Sales\SalesRepresentativeModule;

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
            'brands' => BrandsModule::class,
            'customer' => CustomerModule::class,
            'preferred-vendor' => PreferredVendorModule::class,
            'sales-representative' => SalesRepresentativeModule::class,
        ]);
    }
}
