<?php


namespace App\Domain\Entities\Warehouses\OutboundLogistics;


use App\Domain\Entities\Enums\CustomerStatusEnum;
use App\Domain\Entities\Sales\Customers\Customers;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;
use Dms\Common\Structure\DateTime\Date;
use Dms\Common\Structure\Money\Money;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;

class SalesOrderFulfillment extends Entity
{
        const SALES_ORDER = 'salesOrder';
        const DATE = 'date';
        const STATUS = 'status';
        const PART = 'part';
        const SO_QTY = 'soQty';
        const AVAILABLE = 'available';
        const PACKED = 'packed';
        const SHIPPED = 'shipped';
        const BO = 'bo';
        const PURCHASE_ORDER = 'purchaseOrder';
        const DATE2 = 'date2';
        const STATUS2 = 'status2';
        const PO_QTY = 'poQty';
        const RECEIVING = 'receiving';
        const DATE3 = 'date3';
        const STATUS3 = 'status3';
        const PR_QTY = 'prQty';

    /**
     * @var string
     */
    public $salesOrder;
    /**
     * @var Date
     */
    public $date;
    /**
     * @var string
     */
    public $status;
    /**
     * @var string
     */
    public $part;
    /**
     * @var Date
     */
    public $soQty;
    /**
     * @var string
     */
    public $available;
    /**
     * @var string
     */
    public $packed;
    /**
     * @var Date
     */
    public $shipped;
    /**
     * @var string
     */
    public $bo;
    /**
     * @var string
     */
    public $purchaseOrder;
    /**
     * @var Date
     */
    public $date2;
    /**
     * @var string
     */
    public $status2;
    /**
     * @var string
     */
    public $poQty;
    /**
     * @var Date
     */
    public $receiving;
    /**
     * @var string
     */
    public $date3;
    /**
     * @var string
     */
    public $status3;
    /**
     * @var string
     */
    public $prQty;

    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->salesOrder)->asString();
        $class->property($this->date)->nullable()->asObject(Date::class);
        $class->property($this->status)->asObject(CustomerStatusEnum::class);
        $class->property($this->part)->nullable()->asString();
        $class->property($this->soQty)->nullable()->asInt();
        $class->property($this->available)->asObject(Money::class);
        $class->property($this->packed)->nullable()->asInt();
        $class->property($this->shipped)->nullable()->asInt();
        $class->property($this->bo)->nullable()->asInt();
        $class->property($this->purchaseOrder)->nullable()->asInt();
        $class->property($this->date2)->nullable()->asString();
        $class->property($this->status2)->nullable()->asObject(CustomerStatusEnum::class);
        $class->property($this->poQty)->nullable()->asInt();
        $class->property($this->receiving)->nullable()->asString();
        $class->property($this->date3)->nullable()->asString();
        $class->property($this->status3)->asObject(CustomerStatusEnum::class);
        $class->property($this->prQty)->nullable()->asInt();
    }
}
