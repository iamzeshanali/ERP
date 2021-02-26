<?php declare(strict_types = 1);

namespace App;

use App\Cms\CustomersPackage;
use App\Cms\SalesPackage;
use App\Cms\WarehousesPackage;
use Dms\Core\Cms;
use Dms\Core\CmsDefinition;
use Dms\Web\Laravel\Auth\AdminPackage;
use Dms\Web\Laravel\Document\PublicFilePackage;
use Dms\Package\Analytics\AnalyticsPackage;

/**
 * The application's cms.
 */
class AppCms extends Cms
{
    /**
     * Defines the structure and installed packages of the cms.
     *
     * @param CmsDefinition $cms
     *
     * @return void
     */
    protected function define(CmsDefinition $cms)
    {
        $cms->packages([
            'admin'     => AdminPackage::class,
            'documents' => PublicFilePackage::class,
            'analytics' => AnalyticsPackage::class,

           // TODO: Register your application cms packages...
            'Customers' => CustomersPackage::class,
//            'Sales' => SalesPackage::class,
                'Warehouses' => WarehousesPackage::class
        ]);
    }
}
