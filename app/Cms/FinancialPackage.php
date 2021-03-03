<?php declare(strict_types = 1);

namespace App\Cms;

use App\Cms\Modules\Financial\PurchaseOrderDetailModule;
use App\Cms\Modules\Financial\PurchaseOrderModule;
use App\Cms\Modules\Financial\PurchaseOrderReceivingModule;
use App\Cms\Modules\Financial\ReceiptModule;
use App\Cms\Modules\Financial\SalesInvoiceDetailModule;
use App\Cms\Modules\Financial\SalesInvoiceModule;
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

/**
 * The Financial package.
 */
class FinancialPackage extends Package
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
        $package->name('Financial');

        $package->metadata([
            'icon' => '',
        ]);

        $package->modules([
            'payment-terms' => PaymentTermsModule::class,
            'tax-class' => TaxClassModule::class,
            'purchase-order' => PurchaseOrderModule::class,
            'purchase-order-detail' => PurchaseOrderDetailModule::class,
            'purchase-order-receiving' => PurchaseOrderReceivingModule::class,
            'receipt' => ReceiptModule::class,
            'sales-invoice' => SalesInvoiceModule::class,
            'sales-invoice-detail' => SalesInvoiceDetailModule::class,
        ]);
    }
}
