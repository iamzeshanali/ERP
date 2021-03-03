<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Sales;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Sales\PreferredVendor;

/**
 * The repository for the App\Domain\Entities\Sales\PreferredVendor entity.
 */
interface IPreferredVendorRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return PreferredVendor[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return PreferredVendor
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return PreferredVendor[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PreferredVendor|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return PreferredVendor[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PreferredVendor[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return PreferredVendor[]
     */
    public function satisfying(ISpecification $specification) : array;
}
