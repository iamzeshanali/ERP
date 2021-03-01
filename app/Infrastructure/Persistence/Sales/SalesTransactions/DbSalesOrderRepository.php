<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales\SalesTransactions;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Sales\SalesTransactions\ISalesOrderRepository;
use App\Domain\Entities\Sales\SalesTransactions\SalesOrder;

/**
 * The database repository implementation for the App\Domain\Entities\Sales\SalesTransactions\SalesOrder entity.
 */
class DbSalesOrderRepository extends DbRepository implements ISalesOrderRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(SalesOrder::class));
    }
}