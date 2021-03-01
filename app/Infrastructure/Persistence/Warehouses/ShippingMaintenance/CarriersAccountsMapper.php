<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Warehouses\ShippingMaintenance;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Warehouses\ShippingMaintenance\CarriersAccounts;


/**
 * The App\Domain\Entities\Warehouses\ShippingMaintenance\CarriersAccounts entity mapper.
 */
class CarriersAccountsMapper extends EntityMapper
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
        $map->type(CarriersAccounts::class);
        $map->toTable('carriers_accounts');

        $map->idToPrimaryKey('id');

        $map->property(CarriersAccounts::ACCOUNT_NO)->to('account_no')->asVarchar(255);

        $map->property(CarriersAccounts::CARRIER_NAME)->to('carrier_name')->asVarchar(255);

        $map->property(CarriersAccounts::CONTACT_NAME)->to('contact_name')->asVarchar(255);

        $map->property(CarriersAccounts::COMPANY_NAME)->to('company_name')->asVarchar(255);

        $map->property(CarriersAccounts::ADDRESS_1)->to('address1')->asVarchar(255);

        $map->property(CarriersAccounts::ADDRESS_2)->to('address2')->nullable()->asVarchar(255);

        $map->property(CarriersAccounts::CITY)->to('city')->asVarchar(255);

        $map->property(CarriersAccounts::STATE)->to('state')->asVarchar(255);

        $map->property(CarriersAccounts::ZIP)->to('zip')->asInt();

        $map->property(CarriersAccounts::COUNTRY)->to('country')->nullable()->asVarchar(255);

        $map->property(CarriersAccounts::INACTIVE)->to('in_active')->asBool();


    }
}