<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Sales\SalesTransactions;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Sales\SalesTransactions\Quotation;

/**
 * The repository for the App\Domain\Entities\Sales\SalesTransactions\Quotation entity.
 */
interface IQuotationRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return Quotation[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return Quotation
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return Quotation[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Quotation|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return Quotation[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return Quotation[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return Quotation[]
     */
    public function satisfying(ISpecification $specification) : array;
}
