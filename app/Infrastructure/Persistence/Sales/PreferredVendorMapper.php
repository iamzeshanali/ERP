<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Sales\PreferredVendor;
use Dms\Common\Structure\Web\Persistence\EmailAddressMapper;
use Dms\Common\Structure\Web\Persistence\UrlMapper;
use App\Domain\Entities\Financial\PaymentTerms;

/**
 * The App\Domain\Entities\Sales\PreferredVendor entity mapper.
 */
class PreferredVendorMapper extends EntityMapper
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
        $map->type(PreferredVendor::class);
        $map->toTable('preferred_vendors');

        $map->idToPrimaryKey('id');

        $map->property(PreferredVendor::VENDOR_NUMBER)->to('vendor_number')->nullable()->asVarchar(255);

        $map->property(PreferredVendor::NAME)->to('name')->nullable()->asVarchar(255);

        $map->property(PreferredVendor::ADDRESS_LINE_1)->to('address_line1')->nullable()->asVarchar(255);

        $map->property(PreferredVendor::ADDRESS_LINE_2)->to('address_line2')->nullable()->asVarchar(255);

        $map->property(PreferredVendor::STATE)->to('state')->nullable()->asVarchar(255);

        $map->property(PreferredVendor::ZIP)->to('zip')->nullable()->asVarchar(255);

        $map->property(PreferredVendor::CITY)->to('city')->nullable()->asVarchar(255);

        $map->property(PreferredVendor::COUNTRY)->to('country')->nullable()->asVarchar(255);

        $map->property(PreferredVendor::PHONE)->to('phone')->nullable()->asVarchar(255);

        $map->embedded(PreferredVendor::EMAIL)
            ->withIssetColumn('email')
            ->using(new EmailAddressMapper('email'));

        $map->embedded(PreferredVendor::WEBSITE)
            ->withIssetColumn('website')
            ->using(new UrlMapper('website'));

        $map->column('payment_terms_id')->asUnsignedInt();
        $map->relation(PreferredVendor::PAYMENT_TERMS)
            ->to(PaymentTerms::class)
            ->manyToOne()
            ->withRelatedIdAs('payment_terms_id');

        $map->property(PreferredVendor::LICENSE_NUMBER)->to('license_number')->nullable()->asVarchar(255);

        $map->enum(PreferredVendor::STATUS)->to('status')->usingValuesFromConstants();


    }
}
