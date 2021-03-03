<?php


namespace App\Domain\Entities\Financial;


use App\Domain\Entities\Enums\PurchaseOrderStatus;
use App\Domain\Entities\Sales\PreferredVendor;
use App\Domain\Entities\Warehouse\Shipments;
use Dms\Common\Structure\DateTime\Date;
use Dms\Core\Model\EntityCollection;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;

class PurchaseOrder extends Entity
{
    const VENDOR = 'vendor';
    const DATE = 'date';
    const DOCUMENT_NUMBER = 'documentNumber';
    const INVOICE_NUMBER = 'invoiceNumber';
    const STATUS = 'status';
    const ASSIGNED_TO = 'assignedTo';
    const PAYMENT_TERM = 'paymentTerm';
    const TOTAL = 'total';
    const DISCOUNT = 'discount';
    const DISCOUNT_TYPE = 'discountType';
    const TOTAL_AFTER_DISCOUNT = 'totalAfterDiscount';
    const FINAL_PRICE = 'finalPrice';
    const SHIPPING_ADDRESS_LINE_1 = 'shippingAddressLine1';
    const SHIPPING_ADDRESS_LINE_2 = 'shippingAddressLine2';
    const SHIPPING_STATE = 'shippingState';
    const SHIPPING_ZIP = 'shippingZip';
    const SHIPPING_CITY = 'shippingCity';
    const SHIPPING_COUNTRY = 'shippingCountry';
    const SHIPPING_CODE = 'shippingCode';
    const PURCHASE_ORDER_DETAILS = 'purchaseOrderDetails';
    const PURCHASE_ORDER_RECEIVING = 'purchaseOrderReceiving';

    /**
     * @var PreferredVendor
     */
    public $vendor;

    /**
     * @var Date
     */
    public $date;

    /**
     * @var string
     */
    public $documentNumber;

    /**
     * @var string
     */
    public $invoiceNumber;

    /**
     * @var PurchaseOrderStatus
     */
    public $status;

    /**
     * @var PaymentTerms
     */
    public $paymentTerm;

    /**
     * @var string
     */
    public $total;

    /**
     * @var string
     */
    public $discount;

    /**
     * @var string
     */
    public $discountType;

    /**
     * @var string
     */
    public $totalAfterDiscount;

    /**
     * @var string
     */
    public $finalPrice;

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
     * @var Shipments|null
     */
    public $shippingCode;

    /**
     * @var EntityCollection|PurchaseOrderDetail[]
     */
    public $purchaseOrderDetails;

    /**
     * @var EntityCollection|PurchaseOrderReceiving[]
     */
    public $purchaseOrderReceiving;

    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     * @throws InvalidPropertyDefinitionException
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->vendor)->nullable()->asObject(PreferredVendor::class);
        $class->property($this->date)->nullable()->asObject(Date::class);
        $class->property($this->documentNumber)->nullable()->asString();
        $class->property($this->invoiceNumber)->nullable()->asString();
        $class->property($this->status)->nullable()->asObject(PurchaseOrderStatus::class);
        $class->property($this->paymentTerm)->nullable()->asObject(PaymentTerms::class);
        $class->property($this->total)->nullable()->asString();
        $class->property($this->discount)->nullable()->asString();
        $class->property($this->discountType)->nullable()->asString();
        $class->property($this->totalAfterDiscount)->nullable()->asString();
        $class->property($this->finalPrice)->nullable()->asString();
        $class->property($this->shippingAddressLine1)->nullable()->asString();
        $class->property($this->shippingAddressLine2)->nullable()->asString();
        $class->property($this->shippingState)->nullable()->asString();
        $class->property($this->shippingCity)->nullable()->asString();
        $class->property($this->shippingZip)->nullable()->asString();
        $class->property($this->shippingCountry)->nullable()->asString();
        $class->property($this->shippingCode)->asObject(Shipments::class);

        $class->property($this->purchaseOrderDetails)->asType(PurchaseOrderDetail::collectionType());
        $class->property($this->purchaseOrderReceiving)->asType(PurchaseOrderReceiving::collectionType());


    }
}