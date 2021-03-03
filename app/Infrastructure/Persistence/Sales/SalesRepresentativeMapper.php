<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Sales\SalesRepresentative;
use Dms\Common\Structure\Web\Persistence\EmailAddressMapper;

/**
 * The App\Domain\Entities\Sales\SalesRepresentative entity mapper.
 */
class SalesRepresentativeMapper extends EntityMapper
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
        $map->type(SalesRepresentative::class);
        $map->toTable('sales_representatives');

        $map->idToPrimaryKey('id');

        $map->property(SalesRepresentative::CODE)->to('code')->nullable()->asVarchar(255);

        $map->property(SalesRepresentative::NAME)->to('name')->nullable()->asVarchar(255);

        $map->property(SalesRepresentative::PHONE)->to('phone')->nullable()->asVarchar(255);

        $map->property(SalesRepresentative::CELL)->to('cell')->nullable()->asVarchar(255);

        $map->embedded(SalesRepresentative::EMAIL)
            ->withIssetColumn('email')
            ->using(new EmailAddressMapper('email'));

        $map->enum(SalesRepresentative::STATUS)->to('status')->usingValuesFromConstants();


    }
}