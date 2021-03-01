<?php


namespace App\Domain\Entities\Warehouses\OutboundLogistics;


use App\Domain\Entities\Enums\CustomerStatusEnum;
use App\Domain\Entities\Sales\Customers\Customers;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;
use Dms\Common\Structure\DateTime\Date;
use Dms\Common\Structure\Money\Money;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;

class PickingWorkArea extends Entity
{
    const DOCUMENT = 'document';
    const DATE    = 'date';
    const CUSTOMER     = 'customer';
    const STATUS = 'status';
    const ASSIGNED_TO = 'assignedTo';
    const BRANCH = 'branch';

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
     * @var Admin
     */
    public $assignedTo;
    /**
     * @var float
     */
    public $branch;

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
