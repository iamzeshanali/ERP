<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Inventory;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Inventory\IGroupRepository;
use App\Domain\Entities\Inventory\Group;

/**
 * The database repository implementation for the App\Domain\Entities\Inventory\Group entity.
 */
class DbGroupRepository extends DbRepository implements IGroupRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(Group::class));
    }
}