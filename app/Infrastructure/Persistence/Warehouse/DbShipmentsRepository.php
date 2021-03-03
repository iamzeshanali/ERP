<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouse;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Warehouse\IShipmentsRepository;
use App\Domain\Entities\Warehouse\Shipments;

/**
 * The database repository implementation for the App\Domain\Entities\Warehouse\Shipments entity.
 */
class DbShipmentsRepository extends DbRepository implements IShipmentsRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(Shipments::class));
    }
}