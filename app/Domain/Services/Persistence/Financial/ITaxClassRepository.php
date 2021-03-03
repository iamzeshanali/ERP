<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Financial;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Financial\TaxClass;

/**
 * The repository for the App\Domain\Entities\Financial\TaxClass entity.
 */
interface ITaxClassRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return TaxClass[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return TaxClass
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return TaxClass[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return TaxClass|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return TaxClass[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return TaxClass[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return TaxClass[]
     */
    public function satisfying(ISpecification $specification) : array;
}
