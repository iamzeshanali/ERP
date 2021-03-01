<?php


namespace App\Domain\Entities\Warehouses\ShippingMaintenance;


use App\Domain\Entities\Enums\CustomerStatusEnum;
use App\Domain\Entities\Sales\Customers\Customers;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;
use Dms\Common\Structure\DateTime\Date;
use Dms\Common\Structure\Money\Money;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;

class ShipmentList extends Entity
{
    const DOCUMENT = 'document';
    const DATE    = 'date';
    const CUSTOMER     = 'customer';
    const STATUS = 'status';
    const RATE = 'rate';
    const TRACKING_NUMBERS = 'trackingNumbers';

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
    public $customer;
    /**
     * @var ENUM Status
     */
    public $status;
    /**
     * @var Money
     */
    public $rate;

    /**
     * @var string
     */
    public $trackingNumbers;

    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->document)->asString();
        $class->property($this->date)->nullable()->asObject(Date::class);
        $class->property($this->customer)->asObject(Customers::class);
        $class->property($this->status)->asObject(CustomerStatusEnum::class);
        $class->property($this->rate)->nullable()->asObject(Money::class);
        $class->property($this->trackingNumbers)->nullable()->asString();
    }
}
