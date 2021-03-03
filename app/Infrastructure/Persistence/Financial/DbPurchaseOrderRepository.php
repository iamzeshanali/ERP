<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Financial;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Financial\IPurchaseOrderRepository;
use App\Domain\Entities\Financial\PurchaseOrder;

/**
 * The database repository implementation for the App\Domain\Entities\Financial\PurchaseOrder entity.
 */
class DbPurchaseOrderRepository extends DbRepository implements IPurchaseOrderRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(PurchaseOrder::class));
    }
}