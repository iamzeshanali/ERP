<?php declare(strict_types = 1);

namespace App\Cms;

use Dms\Core\Package\Definition\PackageDefinition;
use Dms\Core\Package\Package;
use App\Cms\Modules\Financial\PaymentTermsModule;
use App\Cms\Modules\Financial\TaxClassModule;
use App\Cms\Modules\Inventory\CasePackModule;
use App\Cms\Modules\Inventory\FamilyModule;
use App\Cms\Modules\Inventory\GroupModule;
use App\Cms\Modules\Inventory\UomModule;
use App\Cms\Modules\Sales\BrandsModule;
use App\Cms\Modules\Sales\CustomerModule;
use App\Cms\Modules\Sales\PreferredVendorModule;
use App\Cms\Modules\Sales\ProductModule;
use App\Cms\Modules\Sales\SalesRepresentativeModule;
use App\Cms\Modules\Warehouse\ShipmentsModule;
use App\Cms\Modules\Warehouse\WarehouseModule;

/**
 * The Warehouse package.
 */
class WarehousePackage extends Package
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
        $package->name('Warehouse');

        $package->metadata([
            'icon' => '',
        ]);

        $package->modules([
            'shipments' => ShipmentsModule::class,
            'warehouse' => WarehouseModule::class,
        ]);
    }
}
