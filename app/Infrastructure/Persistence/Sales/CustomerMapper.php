<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Sales\Customer;
use Dms\Common\Structure\Web\Persistence\EmailAddressMapper;
use App\Domain\Entities\Sales\SalesRepresentative;
use App\Domain\Entities\Financial\PaymentTerms;

/**
 * The App\Domain\Entities\Sales\Customer entity mapper.
 */
class CustomerMapper extends EntityMapper
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
        $map->type(Customer::class);
        $map->toTable('customers');

        $map->idToPrimaryKey('id');

        $map->property(Customer::CUSTOMER_NAME)->to('customer_name')->nullable()->asVarchar(255);

        $map->property(Customer::CUSTOMER_NUMBER)->to('customer_number')->nullable()->asVarchar(255);

        $map->embedded('email')
            ->withIssetColumn('email')
            ->using(new EmailAddressMapper('email'));

        $map->enum(Customer::CUSTOMER_STATUS)->to('customer_status')->usingValuesFromConstants();

        $map->column('sales_representative_id')->asUnsignedInt();
        $map->relation(Customer::SALES_REPRESENTATIVE)
            ->to(SalesRepresentative::class)
            ->manyToOne()
            ->withRelatedIdAs('sales_representative_id');

        $map->property(Customer::ADDRESS_LINE_1)->to('address_line1')->nullable()->asVarchar(255);

        $map->property(Customer::ADDRESS_LINE_2)->to('address_line2')->nullable()->asVarchar(255);

        $map->property(Customer::STATE)->to('state')->nullable()->asVarchar(255);

        $map->property(Customer::ZIP)->to('zip')->nullable()->asVarchar(255);

        $map->property(Customer::CITY)->to('city')->nullable()->asVarchar(255);

        $map->property(Customer::COUNTRY)->to('country')->nullable()->asVarchar(255);

        $map->property(Customer::IS_SHIPPING_SAME)->to('is_shipping_same')->nullable()->asBool();

        $map->property(Customer::SHIPPING_ADDRESS_LINE_1)->to('shipping_address_line1')->nullable()->asVarchar(255);

        $map->property(Customer::SHIPPING_ADDRESS_LINE_2)->to('shipping_address_line2')->nullable()->asVarchar(255);

        $map->property(Customer::SHIPPING_STATE)->to('shipping_state')->nullable()->asVarchar(255);

        $map->property(Customer::SHIPPING_ZIP)->to('shipping_zip')->nullable()->asVarchar(255);

        $map->property(Customer::SHIPPING_CITY)->to('shipping_city')->nullable()->asVarchar(255);

        $map->property(Customer::SHIPPING_COUNTRY)->to('shipping_country')->nullable()->asVarchar(255);

        $map->property(Customer::PHONE)->to('phone')->nullable()->asVarchar(255);

        $map->property('bevLicenceNumber')->to('bev_licence_number')->nullable()->asVarchar(255);

        $map->column('payment_terms_id')->asUnsignedInt();
        $map->relation(Customer::PAYMENT_TERMS)
            ->to(PaymentTerms::class)
            ->manyToOne()
            ->withRelatedIdAs('payment_terms_id');

        $map->property(Customer::NUMBER_OF_PALLETS)->to('number_of_pallets')->nullable()->asVarchar(255);


    }
}
