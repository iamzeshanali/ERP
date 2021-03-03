<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Financial;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Financial\PurchaseOrderReceiving;

/**
 * The repository for the App\Domain\Entities\Financial\PurchaseOrderReceiving entity.
 */
interface IPurchaseOrderReceivingRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderReceiving[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderReceiving
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderReceiving[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderReceiving|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderReceiving[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderReceiving[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return PurchaseOrderReceiving[]
     */
    public function satisfying(ISpecification $specification) : array;
}
