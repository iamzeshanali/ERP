<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales\Customers;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;
use Dms\Common\Structure\Web\Persistence\EmailAddressMapper;

/**
 * The App\Domain\Entities\Sales\Customers\SalesRepresentative entity mapper.
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

        $map->property(SalesRepresentative::CODE)->to('code')->asVarchar(255);

        $map->property(SalesRepresentative::FIRST_NAME)->to('first_name')->asVarchar(255);

        $map->property(SalesRepresentative::LAST_NAME)->to('last_name')->nullable()->asVarchar(255);

        $map->property(SalesRepresentative::COMMISSION)->to('commission')->asDecimal(16, 8);

        $map->property(SalesRepresentative::PHONE)->to('phone')->nullable()->asVarchar(255);

        $map->property(SalesRepresentative::CELL)->to('cell')->nullable()->asVarchar(255);

        $map->embedded(SalesRepresentative::EMAIL)
            ->withIssetColumn('email')
            ->using(new EmailAddressMapper('email'));

        $map->property(SalesRepresentative::INACTIVE)->to('in_active')->asBool();


    }
}