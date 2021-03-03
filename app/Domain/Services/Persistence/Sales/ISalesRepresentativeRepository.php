<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Sales;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Sales\SalesRepresentative;

/**
 * The repository for the App\Domain\Entities\Sales\SalesRepresentative entity.
 */
interface ISalesRepresentativeRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return SalesRepresentative[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesRepresentative
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return SalesRepresentative[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesRepresentative|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return SalesRepresentative[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesRepresentative[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesRepresentative[]
     */
    public function satisfying(ISpecification $specification) : array;
}
