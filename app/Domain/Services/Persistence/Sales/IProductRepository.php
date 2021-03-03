<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Sales;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Sales\Product;

/**
 * The repository for the App\Domain\Entities\Sales\Product entity.
 */
interface IProductRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return Product[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return Product
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return Product[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Product|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return Product[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Product[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return Product[]
     */
    public function satisfying(ISpecification $specification) : array;
}
