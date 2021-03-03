<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Inventory;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Inventory\Family;

/**
 * The repository for the App\Domain\Entities\Inventory\Family entity.
 */
interface IFamilyRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return Family[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return Family
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return Family[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Family|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return Family[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Family[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return Family[]
     */
    public function satisfying(ISpecification $specification) : array;
}
