<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Warehouses\ShippingMaintenance;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Warehouses\ShippingMaintenance\ShipmentList;

/**
 * The repository for the App\Domain\Entities\Warehouses\ShippingMaintenance\ShipmentList entity.
 */
interface IShipmentListRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return ShipmentList[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return ShipmentList
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return ShipmentList[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return ShipmentList|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return ShipmentList[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return ShipmentList[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return ShipmentList[]
     */
    public function satisfying(ISpecification $specification) : array;
}
