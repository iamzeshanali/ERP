<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Sales;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Sales\Product;
use App\Domain\Entities\Inventory\Family;
use App\Domain\Entities\Sales\Brands;
use App\Domain\Entities\Financial\TaxClass;
use App\Domain\Entities\Sales\PreferredVendor;
use App\Domain\Entities\Inventory\Uom;
use App\Domain\Entities\Inventory\Group;
use App\Domain\Entities\Inventory\CasePack;

/**
 * The App\Domain\Entities\Sales\Product entity mapper.
 */
class ProductMapper extends EntityMapper
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
        $map->type(Product::class);
        $map->toTable('products');

        $map->idToPrimaryKey('id');

        $map->property(Product::CODE)->to('code')->nullable()->asVarchar(255);

        $map->property(Product::DESCRIPTION)->to('description')->nullable()->asVarchar(255);

        $map->enum(Product::PRODUCT_STATUS)->to('product_status')->usingValuesFromConstants();

        $map->enum(Product::PRODUCT_TYPE)->to('product_type')->usingValuesFromConstants();

        $map->column('family_id')->asUnsignedInt();
        $map->relation(Product::FAMILY)
            ->to(Family::class)
            ->manyToOne()
            ->withRelatedIdAs('family_id');

        $map->column('brands_id')->asUnsignedInt();
        $map->relation(Product::BRAND)
            ->to(Brands::class)
            ->manyToOne()
            ->withRelatedIdAs('brands_id');

        $map->column('tax_class_id')->asUnsignedInt();
        $map->relation(Product::TAX_CLASSIFICATION)
            ->to(TaxClass::class)
            ->manyToOne()
            ->withRelatedIdAs('tax_class_id');

        $map->column('preferred_vendor_id')->asUnsignedInt();
        $map->relation(Product::PREFERRED_VENDOR)
            ->to(PreferredVendor::class)
            ->manyToOne()
            ->withRelatedIdAs('preferred_vendor_id');

        $map->column('uom_id')->asUnsignedInt();
        $map->relation(Product::UOM)
            ->to(Uom::class)
            ->manyToOne()
            ->withRelatedIdAs('uom_id');

        $map->column('group_id')->asUnsignedInt();
        $map->relation(Product::GROUP)
            ->to(Group::class)
            ->manyToOne()
            ->withRelatedIdAs('group_id');

        $map->column('case_pack_id')->asUnsignedInt();
        $map->relation(Product::CASE_PACK)
            ->to(CasePack::class)
            ->manyToOne()
            ->withRelatedIdAs('case_pack_id');

        $map->property(Product::SALE_PRICE)->to('sale_price')->nullable()->asVarchar(255);

        $map->property(Product::MIN_SALE_PRICE)->to('min_sale_price')->nullable()->asVarchar(255);

        $map->property(Product::PURCHASED_PRICE)->to('purchased_price')->nullable()->asVarchar(255);

        $map->property(Product::margin)->to('margin')->nullable()->asVarchar(255);

        $map->property(Product::ON_HAND)->to('on_hand')->nullable()->asVarchar(255);


    }
}
