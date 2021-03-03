<?php


namespace App\Domain\Entities\Financial;


use App\Domain\Entities\Sales\Brands;
use App\Domain\Entities\Sales\Product;
use Dms\Common\Structure\DateTime\Date;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;


class SalesInvoiceDetail extends Entity
{
    const PRODUCT = 'product';
    const QUANTITY = 'quantity';
    const PRICE = 'price';
    const AVAILABILITY = 'available';
    const DUE_DATE= 'dueDate';
    const DISCOUNT= 'discount';
    const DISCOUNT_TYPE= 'discountType';
    const TOTAL= 'total';
    const BRAND= 'brand';
    const SALES_INVOICE = 'salesInvoice';

    /**
     * @var Product|null
     */
    public $product;

    /**
     * @var string|null
     */
    public $quantity;

    /**
     * @var string|null
     */
    public $price;

    /**
     * @var string|null
     */
    public $availability;

    /**
     * @var Date|null
     */
    public $dueDate;

    /**
     * @var string|null
     */
    public $discount;

    /**
     * @var string|null
     */
    public $discountType;

    /**
     * @var string|null
     */
    public $total;

    /**
     * @var Brands|null
     */
    public $brand;

    /**
     * @var SalesInvoice
     */
    public $salesInvoice;

    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     * @throws InvalidPropertyDefinitionException
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->product)->asObject(Product::class);
        $class->property($this->quantity)->nullable()->asString();
        $class->property($this->price)->nullable()->asString();
        $class->property($this->availability)->nullable()->asString();
        $class->property($this->dueDate)->asObject(Date::class);
        $class->property($this->discount)->nullable()->asString();
        $class->property($this->discountType)->nullable()->asString();
        $class->property($this->total)->nullable()->asString();
        $class->property($this->brand)->nullable()->asObject(Brands::class);
        $class->property($this->salesInvoice)->asObject(SalesInvoice::class);
    }
}