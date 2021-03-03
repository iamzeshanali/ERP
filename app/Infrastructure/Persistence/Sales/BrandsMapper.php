<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Sales\Brands;
use Dms\Common\Structure\Web\Persistence\HtmlMapper;

/**
 * The App\Domain\Entities\Sales\Brands entity mapper.
 */
class BrandsMapper extends EntityMapper
{
    /**
     * Defines the entity mapper
     *
     * @param MapperDefinition $map
     *
     * @return void
     */
    protected function define(MapperDefinition $map)
    {
        $map->type(Brands::class);
        $map->toTable('brands');

        $map->idToPrimaryKey('id');

        $map->property(Brands::CODE)->to('code')->nullable()->asVarchar(255);

        $map->embedded(Brands::DESCRIPTION)
            ->withIssetColumn('description')
            ->using(new HtmlMapper('description'));

        $map->enum(Brands::STATUS)->to('status')->usingValuesFromConstants();


    }
}