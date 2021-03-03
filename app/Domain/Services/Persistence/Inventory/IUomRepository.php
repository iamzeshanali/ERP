<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Inventory;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Inventory\Uom;

/**
 * The repository for the App\Domain\Entities\Inventory\Uom entity.
 */
interface IUomRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return Uom[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return Uom
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return Uom[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Uom|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return Uom[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Uom[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return Uom[]
     */
    public function satisfying(ISpecification $specification) : array;
}
