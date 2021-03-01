<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Warehouses\OutboundLogistics;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Warehouses\OutboundLogistics\CustomerShipment;

/**
 * The repository for the App\Domain\Entities\Warehouses\OutboundLogistics\CustomerShipment entity.
 */
interface ICustomerShipmentRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return CustomerShipment[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return CustomerShipment
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return CustomerShipment[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return CustomerShipment|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return CustomerShipment[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return CustomerShipment[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return CustomerShipment[]
     */
    public function satisfying(ISpecification $specification) : array;
}
