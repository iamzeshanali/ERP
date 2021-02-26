<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Sales\Customers;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Sales\Customers\CustomersGroups;

/**
 * The repository for the App\Domain\Entities\Sales\Customers\CustomersGroups entity.
 */
interface ICustomersGroupsRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return CustomersGroups[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return CustomersGroups
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return CustomersGroups[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return CustomersGroups|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return CustomersGroups[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return CustomersGroups[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return CustomersGroups[]
     */
    public function satisfying(ISpecification $specification) : array;
}
