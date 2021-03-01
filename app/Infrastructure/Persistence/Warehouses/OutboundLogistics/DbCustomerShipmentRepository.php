<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\OutboundLogistics;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Warehouses\OutboundLogistics\ICustomerShipmentRepository;
use App\Domain\Entities\Warehouses\OutboundLogistics\CustomerShipment;

/**
 * The database repository implementation for the App\Domain\Entities\Warehouses\OutboundLogistics\CustomerShipment entity.
 */
class DbCustomerShipmentRepository extends DbRepository implements ICustomerShipmentRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(CustomerShipment::class));
    }
}