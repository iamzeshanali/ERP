<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales\Customers;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Sales\Customers\ICustomersGroupsRepository;
use App\Domain\Entities\Sales\Customers\CustomersGroups;

/**
 * The database repository implementation for the App\Domain\Entities\Sales\Customers\CustomersGroups entity.
 */
class DbCustomersGroupsRepository extends DbRepository implements ICustomersGroupsRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(CustomersGroups::class));
    }
}