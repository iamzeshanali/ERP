<?php declare(strict_types = 1);

namespace App\Cms;

use Dms\Core\Package\Definition\PackageDefinition;
use Dms\Core\Package\Package;
use App\Cms\Modules\Warehouses\OutboundLogistics\CustomerReturnModule;
use App\Cms\Modules\Warehouses\OutboundLogistics\CustomerShipmentModule;
use App\Cms\Modules\Warehouses\OutboundLogistics\PickingWorkAreaModule;
use App\Cms\Modules\Warehouses\OutboundLogistics\SalesOrderFulfillmentModule;

/**
 * The OutboundLogistics package.
 */
class OutboundLogisticsPackage extends Package
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
        $package->name('OutboundLogistics');

        $package->metadata([
            'icon' => '',
        ]);

        $package->modules([
            'customer-return' => CustomerReturnModule::class,
            'customer-shipment' => CustomerShipmentModule::class,
            'picking-work-area' => PickingWorkAreaModule::class,
            'sales-order-fulfillment' => SalesOrderFulfillmentModule::class,
        ]);
    }
}
