<?php


namespace App\Domain\Entities\Warehouses\InboundLogistics;


use App\Domain\Entities\Enums\CustomerStatusEnum;
use App\Domain\Entities\Sales\Customers\Customers;
use Dms\Common\Structure\DateTime\Date;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;

class VendorReturn extends Entity
{
    const DOCUMENT = 'document';
    const DATE    = 'date';
    const VENDOR     = 'vendor';
    const STATUS = 'status';
    const ASSIGNED_TO = 'assignedTo';
    const BRANCH = 'branch';
    const PAYMENT_TERMS = 'paymentTerms';
    const TYPE_OF_SALE    = 'TypeOfSale';
    const COST_CENTER     = 'costCenter';
    const SHIPPING_CODE = 'shippingCode';
    const ADDRESS = 'address';
    const VENDOR_INVOICE = 'vendorInvoice';
    const PURCHASE_RECEIVING = 'purchaseReceiving';
    const JOURNAL    = 'journal';
    const TRACKING_NUMBER     = 'trackingNumber';
    const RMA_NUMBER = 'rmaNumber';

    /**
     * @var string
     */
    public $document;
    /**
     * @var Date
     */
    public $date;
    /**
     * @var string
     */
    public $vendor;
    /**
     * @var ENUM Status
     */
    public $status;
    /**
     * @var Admin
     */
    public $assignedTo;
    /**
     * @var string
     */
    public $branch;
    /**
     * @var string
     */
    public $paymentTerms;
    /**
     * @var Date
     */
    public $TypeOfSalee;
    /**
     * @var string
     */
    public $costCenter;
    /**
     * @var ENUM Status
     */
    public $shippingCode;
    /**
     * @var Admin
     */
    public $vendorInvoice;
    /**
     * @var string
     */
    public $purchaseReceiving;
    /**
     * @var string
     */
    public $journal;
    /**
     * @var Date
     */
    public $trackingNumber;
    /**
     * @var string
     */
    public $rmaNumber;

    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->document)->asString();
        $class->property($this->date)->nullable()->asObject(Date::class);
        $class->property($this->customer)->asObject(Customers::class);
        $class->property($this->status)->asObject(CustomerStatusEnum::class);
        $class->property($this->assignedTo)->nullable()->asString();
        $class->property($this->branch)->nullable()->asString();
    }

}
