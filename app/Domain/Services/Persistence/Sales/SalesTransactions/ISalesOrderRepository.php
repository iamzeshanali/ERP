<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Sales\SalesTransactions;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Sales\SalesTransactions\SalesOrder;

/**
 * The repository for the App\Domain\Entities\Sales\SalesTransactions\SalesOrder entity.
 */
interface ISalesOrderRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return SalesOrder[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesOrder
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return SalesOrder[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesOrder|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return SalesOrder[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesOrder[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesOrder[]
     */
    public function satisfying(ISpecification $specification) : array;
}
