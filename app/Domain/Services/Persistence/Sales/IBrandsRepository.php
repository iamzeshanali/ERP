<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Sales;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Sales\Brands;

/**
 * The repository for the App\Domain\Entities\Sales\Brands entity.
 */
interface IBrandsRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return Brands[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return Brands
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return Brands[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Brands|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return Brands[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Brands[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return Brands[]
     */
    public function satisfying(ISpecification $specification) : array;
}
