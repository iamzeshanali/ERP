<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouse;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Warehouse\IWarehouseRepository;
use App\Domain\Entities\Warehouse\Warehouse;

/**
 * The database repository implementation for the App\Domain\Entities\Warehouse\Warehouse entity.
 */
class DbWarehouseRepository extends DbRepository implements IWarehouseRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(Warehouse::class));
    }
}