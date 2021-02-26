<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Warehouses\IWarehousesRepository;
use App\Domain\Entities\Warehouses\Warehouses;

/**
 * The database repository implementation for the App\Domain\Entities\Warehouses\Warehouses entity.
 */
class DbWarehousesRepository extends DbRepository implements IWarehousesRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(Warehouses::class));
    }
}