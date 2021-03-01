<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales\SalesTransactions;

use Dms\Core\Persistence\Db\Connection\IConnection;
use Dms\Core\Persistence\Db\Mapping\IOrm;
use Dms\Core\Persistence\DbRepository;
use App\Domain\Services\Persistence\Sales\SalesTransactions\IQuotationRepository;
use App\Domain\Entities\Sales\SalesTransactions\Quotation;

/**
 * The database repository implementation for the App\Domain\Entities\Sales\SalesTransactions\Quotation entity.
 */
class DbQuotationRepository extends DbRepository implements IQuotationRepository
{
    public function __construct(IConnection $connection, IOrm $orm)
    {
        parent::__construct($connection, $orm->getEntityMapper(Quotation::class));
    }
}