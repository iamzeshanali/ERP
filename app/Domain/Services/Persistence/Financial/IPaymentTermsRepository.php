<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Financial;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Financial\PaymentTerms;

/**
 * The repository for the App\Domain\Entities\Financial\PaymentTerms entity.
 */
interface IPaymentTermsRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return PaymentTerms[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return PaymentTerms
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return PaymentTerms[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PaymentTerms|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return PaymentTerms[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PaymentTerms[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return PaymentTerms[]
     */
    public function satisfying(ISpecification $specification) : array;
}
