<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\ShippingMaintenance;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Warehouses\ShippingMaintenance\ICarriersAccountsRepository;
use App\Domain\Entities\Warehouses\ShippingMaintenance\CarriersAccounts;

/**
 * The database repository implementation for the App\Domain\Entities\Warehouses\ShippingMaintenance\CarriersAccounts entity.
 */
class DbCarriersAccountsRepository extends DbRepository implements ICarriersAccountsRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(CarriersAccounts::class));
    }
}