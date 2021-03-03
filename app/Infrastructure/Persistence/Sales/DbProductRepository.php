<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Sales\IProductRepository;
use App\Domain\Entities\Sales\Product;

/**
 * The database repository implementation for the App\Domain\Entities\Sales\Product entity.
 */
class DbProductRepository extends DbRepository implements IProductRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(Product::class));
    }
}