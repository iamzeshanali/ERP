<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Sales\Customers;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Sales\Customers\Customers;

/**
 * The repository for the App\Domain\Entities\Sales\Customers\Customers entity.
 */
interface ICustomersRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return Customers[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return Customers
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return Customers[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Customers|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return Customers[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Customers[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return Customers[]
     */
    public function satisfying(ISpecification $specification) : array;
}
