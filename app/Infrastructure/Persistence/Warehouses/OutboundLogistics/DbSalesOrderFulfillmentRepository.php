<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\OutboundLogistics;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Warehouses\OutboundLogistics\ISalesOrderFulfillmentRepository;
use App\Domain\Entities\Warehouses\OutboundLogistics\SalesOrderFulfillment;

/**
 * The database repository implementation for the App\Domain\Entities\Warehouses\OutboundLogistics\SalesOrderFulfillment entity.
 */
class DbSalesOrderFulfillmentRepository extends DbRepository implements ISalesOrderFulfillmentRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(SalesOrderFulfillment::class));
    }
}