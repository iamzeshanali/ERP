<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Financial;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Financial\IPurchaseOrderDetailRepository;
use App\Domain\Entities\Financial\PurchaseOrderDetail;

/**
 * The database repository implementation for the App\Domain\Entities\Financial\PurchaseOrderDetail entity.
 */
class DbPurchaseOrderDetailRepository extends DbRepository implements IPurchaseOrderDetailRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(PurchaseOrderDetail::class));
    }
}