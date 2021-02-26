<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Warehouses;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Warehouses\Warehouses;

/**
 * The repository for the App\Domain\Entities\Warehouses\Warehouses entity.
 */
interface IWarehousesRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return Warehouses[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return Warehouses
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return Warehouses[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Warehouses|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return Warehouses[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Warehouses[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return Warehouses[]
     */
    public function satisfying(ISpecification $specification) : array;
}
