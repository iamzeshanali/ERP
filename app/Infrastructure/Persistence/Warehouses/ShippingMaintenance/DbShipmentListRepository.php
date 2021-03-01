<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\ShippingMaintenance;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Warehouses\ShippingMaintenance\IShipmentListRepository;
use App\Domain\Entities\Warehouses\ShippingMaintenance\ShipmentList;

/**
 * The database repository implementation for the App\Domain\Entities\Warehouses\ShippingMaintenance\ShipmentList entity.
 */
class DbShipmentListRepository extends DbRepository implements IShipmentListRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(ShipmentList::class));
    }
}