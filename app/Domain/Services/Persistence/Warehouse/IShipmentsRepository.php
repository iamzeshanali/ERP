<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Warehouse;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Warehouse\Shipments;

/**
 * The repository for the App\Domain\Entities\Warehouse\Shipments entity.
 */
interface IShipmentsRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return Shipments[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return Shipments
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return Shipments[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Shipments|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return Shipments[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Shipments[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return Shipments[]
     */
    public function satisfying(ISpecification $specification) : array;
}
