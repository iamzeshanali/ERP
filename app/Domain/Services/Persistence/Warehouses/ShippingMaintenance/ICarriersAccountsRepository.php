<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Warehouses\ShippingMaintenance;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Warehouses\ShippingMaintenance\CarriersAccounts;

/**
 * The repository for the App\Domain\Entities\Warehouses\ShippingMaintenance\CarriersAccounts entity.
 */
interface ICarriersAccountsRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return CarriersAccounts[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return CarriersAccounts
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return CarriersAccounts[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return CarriersAccounts|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return CarriersAccounts[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return CarriersAccounts[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return CarriersAccounts[]
     */
    public function satisfying(ISpecification $specification) : array;
}
