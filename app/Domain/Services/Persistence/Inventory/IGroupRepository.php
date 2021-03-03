<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Inventory;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Inventory\Group;

/**
 * The repository for the App\Domain\Entities\Inventory\Group entity.
 */
interface IGroupRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return Group[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return Group
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return Group[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Group|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return Group[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Group[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return Group[]
     */
    public function satisfying(ISpecification $specification) : array;
}
