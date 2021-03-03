<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Financial;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Financial\IReceiptRepository;
use App\Domain\Entities\Financial\Receipt;

/**
 * The database repository implementation for the App\Domain\Entities\Financial\Receipt entity.
 */
class DbReceiptRepository extends DbRepository implements IReceiptRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(Receipt::class));
    }
}