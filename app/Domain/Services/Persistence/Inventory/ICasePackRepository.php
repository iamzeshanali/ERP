<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Inventory;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Inventory\CasePack;

/**
 * The repository for the App\Domain\Entities\Inventory\CasePack entity.
 */
interface ICasePackRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return CasePack[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return CasePack
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return CasePack[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return CasePack|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return CasePack[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return CasePack[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return CasePack[]
     */
    public function satisfying(ISpecification $specification) : array;
}
