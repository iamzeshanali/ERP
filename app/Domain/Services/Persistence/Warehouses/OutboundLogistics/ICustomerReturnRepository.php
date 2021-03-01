<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Warehouses\OutboundLogistics;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Warehouses\OutboundLogistics\CustomerReturn;

/**
 * The repository for the App\Domain\Entities\Warehouses\OutboundLogistics\CustomerReturn entity.
 */
interface ICustomerReturnRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return CustomerReturn[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return CustomerReturn
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return CustomerReturn[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return CustomerReturn|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return CustomerReturn[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return CustomerReturn[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return CustomerReturn[]
     */
    public function satisfying(ISpecification $specification) : array;
}
