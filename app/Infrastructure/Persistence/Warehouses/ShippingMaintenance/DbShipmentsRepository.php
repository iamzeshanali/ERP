<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\ShippingMaintenance;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Warehouses\ShippingMaintenance\IShipmentsRepository;
use App\Domain\Entities\Warehouses\ShippingMaintenance\Shipments;

/**
 * The database repository implementation for the App\Domain\Entities\Warehouses\ShippingMaintenance\Shipments entity.
 */
class DbShipmentsRepository extends DbRepository implements IShipmentsRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(Shipments::class));
    }
}