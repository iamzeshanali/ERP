<?php declare(strict_types = 1);

namespace App\Cms;

use Dms\Core\Package\Definition\PackageDefinition;
use Dms\Core\Package\Package;
use App\Cms\Modules\Sales\SalesTransactions\QuotationModule;
use App\Cms\Modules\Sales\SalesTransactions\SalesOrderModule;

/**
 * The SalesTransaction package.
 */
class SalesTransactionPackage extends Package
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
        $package->name('SalesTransaction');

        $package->metadata([
            'icon' => '',
        ]);

        $package->modules([
            'quotation' => QuotationModule::class,
            'sales-order' => SalesOrderModule::class,
        ]);
    }
}
