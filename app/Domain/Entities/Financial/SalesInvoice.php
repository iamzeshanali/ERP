<?php


namespace App\Domain\Entities\Financial;


use App\Domain\Entities\Enums\InvoiceStatus;
use App\Domain\Entities\Sales\Customer;
use App\Domain\Entities\Sales\SalesRepresentative;
use App\Domain\Entities\Warehouse\Shipments;
use App\Domain\Entities\Warehouse\Warehouse;
use Dms\Common\Structure\DateTime\Date;
use Dms\Core\Model\EntityCollection;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;
use Dms\Web\Laravel\Auth\Admin;

class SalesInvoice extends Entity
{
    const CUSTOMER = 'customer';
    const DATE = 'date';
    const INVOICE_NUMBER = 'invoiceNumber';
    const STATUS = 'status';
    // const ASSIGNED = 'assigned';
    const SHIPPING_ADDRESS_LINE_1 = 'shippingAddressLine1';
    const SHIPPING_ADDRESS_LINE_2 = 'shippingAddressLine2';
    const SHIPPING_STATE = 'shippingState';
    const SHIPPING_ZIP = 'shippingZip';
    const SHIPPING_CITY = 'shippingCity';
    const SHIPPING_COUNTRY = 'shippingCountry';
    const SHIPPING_CODE = 'shippingCode';
    const SALES_REP = 'salesRep';
    const PAYMENT_TERMS = 'paymentTerms';
    const WAREHOUSE = 'warehouse';
    const PROFIT_IN_PERCENT = 'profitInPercent';
    const PROFIT_IN_DOLLAR = 'profitInDollar';
    const TOTAL = 'total';
    const DISCOUNT_IN_PERCENT = 'discountInPercent';
    const DISCOUNT_IN_DOLLAR = 'discountInDollar';
    const TOTAL_AFTER_DISCOUNT = 'totalAfterDiscount';
    const TOTAL_TAX = 'totalTax';
    const FINAL_PRICE = 'finalPrice';
    const SALES_INVOICE_DETAIL = 'salesInvoiceDetail';

    /**
     * @var Customer|null
     */
    public $customer;

    /**
     * @var Date|null
     */
    public $date;

    /**
     * @var string|null
     */
    public $invoiceNumber;

    /**
     * @var InvoiceStatus|null
     */
    public $status;

    /**
     * @var Admin|null
     */
    // public $assigned;

    /**
     * @var string|null
     */
    public $shippingAddressLine1;

    /**
     * @var string|null
     */
    public $shippingAddressLine2;

    /**
     * @var string|null
     */
    public $shippingState;

    /**
     * @var string|null
     */
    public $shippingZip;

    /**
     * @var string|null
     */
    public $shippingCity;

    /**
     * @var string|null
     */
    public $shippingCountry;

    /**
     * @var SalesRepresentative|null
     */
    public $salesRep;

    /**
     * @var Shipments|null
     */
    public $shippingCode;

    /**
     * @var PaymentTerms|null
     */
    public $paymentTerms;

    /**
     * @var Warehouse|null
     */
    public $warehouse;

    /**
     * @var string|null
     */
    public $profitInPercent;

    /**
     * @var string|null
     */
    public $profitInDollar;

    /**
     * @var string|null
     */
    public $total;

    /**
     * @var string|null
     */
    public $discountInPercent;

    /**
     * @var string|null
     */
    public $discountInDollar;

    /**
     * @var string|null
     */
    public $totalAfterDiscount;

    /**
     * @var string|null
     */
    public $totalTax;

    /**
     * @var string|null
     */
    public $finalPrice;

    /**
     * @var EntityCollection|SalesInvoiceDetail[]
     */
    public $salesInvoiceDetail;

    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     * @throws InvalidPropertyDefinitionException
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->customer)->asObject(Customer::class);
        $class->property($this->date)->asObject(Date::class);
        $class->property($this->invoiceNumber)->asString();
        $class->property($this->status)->asObject(InvoiceStatus::class);
        // $class->property($this->assigned)->nullable()->asObject(Admin::class);
        $class->property($this->shippingAddressLine1)->nullable()->asString();
        $class->property($this->shippingAddressLine2)->nullable()->asString();
        $class->property($this->shippingState)->nullable()->asString();
        $class->property($this->shippingCity)->nullable()->asString();
        $class->property($this->shippingZip)->nullable()->asString();
        $class->property($this->shippingCountry)->nullable()->asString();
        $class->property($this->salesRep)->asObject(SalesRepresentative::class);
        $class->property($this->shippingCode)->asObject(Shipments::class);
        $class->property($this->paymentTerms)->asObject(PaymentTerms::class);
        $class->property($this->warehouse)->asObject(Warehouse::class);
        $class->property($this->profitInDollar)->nullable()->asString();
        $class->property($this->profitInPercent)->nullable()->asString();
        $class->property($this->total)->nullable()->asString();
        $class->property($this->discountInDollar)->nullable()->asString();
        $class->property($this->discountInPercent)->nullable()->asString();
        $class->property($this->totalAfterDiscount)->nullable()->asString();
        $class->property($this->totalTax)->nullable()->asString();
        $class->property($this->finalPrice)->nullable()->asString();
        $class->property($this->salesInvoiceDetail)->asType(SalesInvoiceDetail::collectionType());

    }
}