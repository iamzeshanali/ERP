<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales\Customers;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Sales\Customers\Customers;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;
use Dms\Common\Structure\Web\Persistence\EmailAddressMapper;
use App\Domain\Entities\Sales\Customers\CustomersGroups;

/**
 * The App\Domain\Entities\Sales\Customers\Customers entity mapper.
 */
class CustomersMapper extends EntityMapper
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
        $map->type(Customers::class);
        $map->toTable('customers');

        $map->idToPrimaryKey('id');

        $map->property(Customers::NUMBER)->to('number')->asVarchar(255);

        $map->property(Customers::FIRST_NAME)->to('first_name')->asVarchar(255);

        $map->property(Customers::LAST_NAME)->to('last_name')->asVarchar(255);

        $map->enum(Customers::STATUS)->to('status')->usingValuesFromConstants();

        $map->column('sales_representative_id')->asUnsignedInt();

        $map->relation(Customers::SALES_REPRESENTATIVE)
            ->to(SalesRepresentative::class)
            ->manyToOne()
            ->withRelatedIdAs('sales_representative_id');

        $map->property(Customers::TAX)->to('tax')->asVarchar(255);

        $map->property(Customers::ADDRESS)->to('address')->asVarchar(255);

        $map->property(Customers::CITY)->to('city')->asVarchar(255);

        $map->property(Customers::STATE)->to('state')->asVarchar(255);

        $map->property(Customers::ZIP)->to('zip')->asInt();

        $map->property(Customers::COUNTRY)->to('country')->nullable()->asVarchar(255);

        $map->property(Customers::PHONE)->to('phone')->nullable()->asVarchar(255);

        $map->property(Customers::FAX)->to('fax')->nullable()->asVarchar(255);

        $map->embedded(Customers::EMAIL)
            ->withIssetColumn('email')
            ->using(new EmailAddressMapper('email'));

        $map->column('customers_groups_id')->asUnsignedInt();

        $map->relation(Customers::GROUP)
            ->to(CustomersGroups::class)
            ->manyToOne()
            ->withRelatedIdAs('customers_groups_id');


    }
}
