<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\OutboundLogistics;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Warehouses\OutboundLogistics\ICustomerReturnRepository;
use App\Domain\Entities\Warehouses\OutboundLogistics\CustomerReturn;

/**
 * The database repository implementation for the App\Domain\Entities\Warehouses\OutboundLogistics\CustomerReturn entity.
 */
class DbCustomerReturnRepository extends DbRepository implements ICustomerReturnRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(CustomerReturn::class));
    }
}