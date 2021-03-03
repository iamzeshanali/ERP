<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Financial;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Financial\PurchaseOrderDetail;

/**
 * The repository for the App\Domain\Entities\Financial\PurchaseOrderDetail entity.
 */
interface IPurchaseOrderDetailRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderDetail[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderDetail
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderDetail[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderDetail|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderDetail[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderDetail[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderDetail[]
     */
    public function satisfying(ISpecification $specification) : array;
}
