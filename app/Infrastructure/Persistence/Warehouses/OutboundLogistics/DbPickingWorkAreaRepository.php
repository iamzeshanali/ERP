<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\OutboundLogistics;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Warehouses\OutboundLogistics\IPickingWorkAreaRepository;
use App\Domain\Entities\Warehouses\OutboundLogistics\PickingWorkArea;

/**
 * The database repository implementation for the App\Domain\Entities\Warehouses\OutboundLogistics\PickingWorkArea entity.
 */
class DbPickingWorkAreaRepository extends DbRepository implements IPickingWorkAreaRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(PickingWorkArea::class));
    }
}