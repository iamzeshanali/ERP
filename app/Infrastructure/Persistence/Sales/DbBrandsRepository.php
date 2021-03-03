<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Sales\IBrandsRepository;
use App\Domain\Entities\Sales\Brands;

/**
 * The database repository implementation for the App\Domain\Entities\Sales\Brands entity.
 */
class DbBrandsRepository extends DbRepository implements IBrandsRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(Brands::class));
    }
}