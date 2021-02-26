<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales\Customers;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Sales\Customers\ISalesRepresentativeRepository;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;

/**
 * The database repository implementation for the App\Domain\Entities\Sales\Customers\SalesRepresentative entity.
 */
class DbSalesRepresentativeRepository extends DbRepository implements ISalesRepresentativeRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(SalesRepresentative::class));
    }
}