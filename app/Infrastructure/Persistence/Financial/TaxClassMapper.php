<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Financial;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Financial\TaxClass;
use Dms\Common\Structure\Web\Persistence\HtmlMapper;

/**
 * The App\Domain\Entities\Financial\TaxClass entity mapper.
 */
class TaxClassMapper extends EntityMapper
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
        $map->type(TaxClass::class);
        $map->toTable('tax_classes');

        $map->idToPrimaryKey('id');

        $map->property(TaxClass::CODE)->to('code')->nullable()->asVarchar(255);

        $map->embedded(TaxClass::DESCRIPTION)
            ->withIssetColumn('description')
            ->using(new HtmlMapper('description'));

        $map->property(TaxClass::ABV)->to('abv')->nullable()->asVarchar(255);

        $map->enum(TaxClass::STATUS)->to('status')->usingValuesFromConstants();


    }
}