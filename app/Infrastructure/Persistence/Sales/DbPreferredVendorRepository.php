<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Sales\IPreferredVendorRepository;
use App\Domain\Entities\Sales\PreferredVendor;

/**
 * The database repository implementation for the App\Domain\Entities\Sales\PreferredVendor entity.
 */
class DbPreferredVendorRepository extends DbRepository implements IPreferredVendorRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(PreferredVendor::class));
    }
}