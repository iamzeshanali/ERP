<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Warehouses\OutboundLogistics;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Warehouses\OutboundLogistics\SalesOrderFulfillment;

/**
 * The repository for the App\Domain\Entities\Warehouses\OutboundLogistics\SalesOrderFulfillment entity.
 */
interface ISalesOrderFulfillmentRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return SalesOrderFulfillment[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesOrderFulfillment
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return SalesOrderFulfillment[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesOrderFulfillment|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return SalesOrderFulfillment[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesOrderFulfillment[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesOrderFulfillment[]
     */
    public function satisfying(ISpecification $specification) : array;
}
