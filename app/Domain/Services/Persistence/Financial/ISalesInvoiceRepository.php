<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Financial;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Financial\SalesInvoice;

/**
 * The repository for the App\Domain\Entities\Financial\SalesInvoice entity.
 */
interface ISalesInvoiceRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return SalesInvoice[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesInvoice
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return SalesInvoice[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesInvoice|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return SalesInvoice[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesInvoice[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesInvoice[]
     */
    public function satisfying(ISpecification $specification) : array;
}
