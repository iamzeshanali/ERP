<?php declare(strict_types = 1);

namespace App\Cms;

use Dms\Core\Package\Definition\PackageDefinition;
use Dms\Core\Package\Package;
use App\Cms\Modules\Sales\ProductModule;

/**
 * The Product package.
 */
class ProductPackage extends Package
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
        $package->name('Product');

        $package->metadata([
            'icon' => '',
        ]);

        $package->modules([
            'product' => ProductModule::class,
        ]);
    }
}
