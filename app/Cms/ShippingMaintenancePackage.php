<?php declare(strict_types = 1);

namespace App\Cms;

use Dms\Core\Package\Definition\PackageDefinition;
use Dms\Core\Package\Package;
use App\Cms\Modules\Warehouses\ShippingMaintenance\CarriersAccountsModule;
use App\Cms\Modules\Warehouses\ShippingMaintenance\ShipmentListModule;
use App\Cms\Modules\Warehouses\ShippingMaintenance\ShipmentsModule;

/**
 * The ShippingMaintenance package.
 */
class ShippingMaintenancePackage extends Package
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
        $package->name('ShippingMaintenance');

        $package->metadata([
            'icon' => 'accessible-icon',
        ]);

        $package->modules([
            'shipments' => ShipmentsModule::class,
            'carriers-accounts' => CarriersAccountsModule::class,
            'shipment-list' => ShipmentListModule::class,
        ]);
    }
}
