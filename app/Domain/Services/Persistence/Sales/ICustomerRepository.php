<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Sales;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Sales\Customer;

/**
 * The repository for the App\Domain\Entities\Sales\Customer entity.
 */
interface ICustomerRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return Customer[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return Customer
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return Customer[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Customer|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return Customer[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Customer[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return Customer[]
     */
    public function satisfying(ISpecification $specification) : array;
}
