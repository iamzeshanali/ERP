<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales\SalesMaintenance;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Sales\SalesMaintenance\ITypeofSalesRepository;
use App\Domain\Entities\Sales\SalesMaintenance\TypeofSales;

/**
 * The database repository implementation for the App\Domain\Entities\Sales\SalesMaintenance\TypeofSales entity.
 */
class DbTypeofSalesRepository extends DbRepository implements ITypeofSalesRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(TypeofSales::class));
    }
}