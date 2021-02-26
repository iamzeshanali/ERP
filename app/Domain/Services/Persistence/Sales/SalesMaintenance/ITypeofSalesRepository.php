<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Sales\SalesMaintenance;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Sales\SalesMaintenance\TypeofSales;

/**
 * The repository for the App\Domain\Entities\Sales\SalesMaintenance\TypeofSales entity.
 */
interface ITypeofSalesRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return TypeofSales[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return TypeofSales
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return TypeofSales[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return TypeofSales|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return TypeofSales[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return TypeofSales[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return TypeofSales[]
     */
    public function satisfying(ISpecification $specification) : array;
}
