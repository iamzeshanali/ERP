<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Financial;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Financial\SalesInvoiceDetail;

/**
 * The repository for the App\Domain\Entities\Financial\SalesInvoiceDetail entity.
 */
interface ISalesInvoiceDetailRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return SalesInvoiceDetail[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesInvoiceDetail
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return SalesInvoiceDetail[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesInvoiceDetail|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return SalesInvoiceDetail[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesInvoiceDetail[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return SalesInvoiceDetail[]
     */
    public function satisfying(ISpecification $specification) : array;
}
