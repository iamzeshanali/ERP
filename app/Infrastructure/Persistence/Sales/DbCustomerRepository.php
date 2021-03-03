<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Sales\ICustomerRepository;
use App\Domain\Entities\Sales\Customer;

/**
 * The database repository implementation for the App\Domain\Entities\Sales\Customer entity.
 */
class DbCustomerRepository extends DbRepository implements ICustomerRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(Customer::class));
    }
}