<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Warehouse;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Warehouse\Warehouse;

/**
 * The repository for the App\Domain\Entities\Warehouse\Warehouse entity.
 */
interface IWarehouseRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return Warehouse[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return Warehouse
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return Warehouse[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Warehouse|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return Warehouse[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Warehouse[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return Warehouse[]
     */
    public function satisfying(ISpecification $specification) : array;
}
