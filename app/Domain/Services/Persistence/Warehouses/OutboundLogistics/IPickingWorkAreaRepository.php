<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Warehouses\OutboundLogistics;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Warehouses\OutboundLogistics\PickingWorkArea;

/**
 * The repository for the App\Domain\Entities\Warehouses\OutboundLogistics\PickingWorkArea entity.
 */
interface IPickingWorkAreaRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return PickingWorkArea[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return PickingWorkArea
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return PickingWorkArea[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PickingWorkArea|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return PickingWorkArea[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PickingWorkArea[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return PickingWorkArea[]
     */
    public function satisfying(ISpecification $specification) : array;
}
