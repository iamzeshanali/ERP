<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Inventory;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Inventory\ICasePackRepository;
use App\Domain\Entities\Inventory\CasePack;

/**
 * The database repository implementation for the App\Domain\Entities\Inventory\CasePack entity.
 */
class DbCasePackRepository extends DbRepository implements ICasePackRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(CasePack::class));
    }
}