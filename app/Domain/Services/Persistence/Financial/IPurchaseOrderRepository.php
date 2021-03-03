<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Financial;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Financial\PurchaseOrder;

/**
 * The repository for the App\Domain\Entities\Financial\PurchaseOrder entity.
 */
interface IPurchaseOrderRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrder[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrder
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrder[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrder|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrder[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrder[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrder[]
     */
    public function satisfying(ISpecification $specification) : array;
}
