<?php declare(strict_types = 1);

namespace App\Domain\Services\Persistence\Sales\SalesMaintenance;

use Dms\Core\Model\ICriteria;
use Dms\Core\Model\ISpecification;
use Dms\Core\Persistence\IRepository;
use App\Domain\Entities\Sales\SalesMaintenance\PipelineMetrics;

/**
 * The repository for the App\Domain\Entities\Sales\SalesMaintenance\PipelineMetrics entity.
 */
interface IPipelineMetricsRepository extends IRepository
{
    /**
     * {@inheritDoc}
     *
     * @return PipelineMetrics[]
     */
    public function getAll() : array;

    /**
     * {@inheritDoc}
     *
     * @return PipelineMetrics
     */
    public function get($id);

    /**
     * {@inheritDoc}
     *
     * @return PipelineMetrics[]
     */
    public function getAllById(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PipelineMetrics|null
     */
    public function tryGet($id);

    /**
     * {@inheritDoc}
     *
     * @return PipelineMetrics[]
     */
    public function tryGetAll(array $ids) : array;

    /**
     * {@inheritDoc}
     *
     * @return PipelineMetrics[]
     */
    public function matching(ICriteria $criteria) : array;

    /**
     * {@inheritDoc}
     *
     * @return PipelineMetrics[]
     */
    public function satisfying(ISpecification $specification) : array;
}
