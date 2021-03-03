<?php


namespace App\Domain\Entities\Sales;


use App\Domain\Entities\Enums\ProductStatus;
use App\Domain\Entities\Enums\ProductType;
use App\Domain\Entities\Financial\TaxClass;
use App\Domain\Entities\Inventory\CasePack;
use App\Domain\Entities\Inventory\Family;
use App\Domain\Entities\Inventory\Group;
use App\Domain\Entities\Inventory\Uom;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;

class Product extends Entity
{
    const CODE = 'code';
    const DESCRIPTION = 'description';
    const PRODUCT_STATUS = 'productStatus';
    const PRODUCT_TYPE = 'productType';
    const FAMILY = 'family';
    const BRAND = 'brand';
    const TAX_CLASSIFICATION = 'taxClassification';
    const PREFERRED_VENDOR = 'preferredVendor';
    const UOM = 'uom';
    const GROUP = 'group';
    const CASE_PACK = 'casePack';
    const SALE_PRICE = 'salePrice';
    const MIN_SALE_PRICE = 'minSalePrice';
    const PURCHASED_PRICE = 'purchasedPrice';
    const margin = 'margin';
    const ON_HAND = 'onHand';
    const OPEN_PURCHASE_ORDER = 'openPurchaseOrder';
    const OPEN_SALE_ORDER = 'openSaleOrder';

    /**
     * @var string|null
     */
    public $code;

    /**
     * @var string|null
     */
    public $description;

    /**
     * @var ProductStatus|null
     */
    public $productStatus;

    /**
     * @var ProductType|null
     */
    public $productType;

    /**
     * @var Family|null
     */
    public $family;

    /**
     * @var Brands|null
     */
    public $brand;

    /**
     * @var TaxClass|null
     */
    public $taxClassification;

    /**
     * @var PreferredVendor|null
     */
    public $preferredVendor;

    /**
     * @var Uom|null
     */
    public $uom;

    /**
     * @var Group|null
     */
    public $group;

    /**
     * @var CasePack|null
     */
    public $casePack;

    /**
     * @var string|null
     */
    public $salePrice;

    /**
     * @var string|null
     */
    public $minSalePrice;

    /**
     * @var string|null
     */
    public $purchasedPrice;

    /**
     * @var string|null
     */
    public $margin;

    /**
     * @var string|null
     */
    public $onHand;




    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     * @throws InvalidPropertyDefinitionException
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->code)->nullable()->asString();
        $class->property($this->description)->nullable()->asString();
        $class->property($this->productStatus)->nullable()->asObject(ProductStatus::class);
        $class->property($this->productType)->nullable()->asObject(ProductType::class);
        $class->property($this->family)->nullable()->asObject(Family::class);
        $class->property($this->brand)->nullable()->asObject(Brands::class);
        $class->property($this->taxClassification)->nullable()->asObject(TaxClass::class);
        $class->property($this->preferredVendor)->nullable()->asObject(PreferredVendor::class);
        $class->property($this->uom)->nullable()->asObject(Uom::class);
        $class->property($this->group)->nullable()->asObject(Group::class);
        $class->property($this->casePack)->nullable()->asObject(CasePack::class);
        $class->property($this->salePrice)->nullable()->asString();
        $class->property($this->minSalePrice)->nullable()->asString();
        $class->property($this->purchasedPrice)->nullable()->asString();
        $class->property($this->margin)->nullable()->asString();
        $class->property($this->onHand)->nullable()->asString();

    }
}