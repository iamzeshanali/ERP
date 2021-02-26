<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Sales\SalesMaintenance;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Sales\SalesMaintenance\Branches;

/**
 * The repository for the App\Domain\Entities\Sales\SalesMaintenance\Branches entity.
 */
interface IBranchesRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return Branches[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return Branches
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return Branches[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Branches|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return Branches[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Branches[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return Branches[]
     */
    public function satisfying(ISpecification $specification) : array;
}
