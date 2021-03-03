<?php


namespace App\Domain\Entities\Financial;


use App\Domain\Entities\Enums\ReceiptStatus;
use App\Domain\Entities\Sales\Customer;
use Dms\Common\Structure\DateTime\Date;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;
use Dms\Web\Laravel\Auth\Admin;

class Receipt extends Entity
{

    const CUSTOMER = 'customer';
    const CASH = 'cash';
    const RECEIPT_NUMBER = 'receiptNumber';
    const DATE = 'date';
    const STATUS = 'status';
//    const ASSIGNED_TO = 'assignedTo';
    const TOTAL_RECEIVED = 'totalReceived';
    const AMOUNT_DUE = 'amountDue';
    const BALANCE_DUE = 'balanceDue';

    /**
     * @var Customer
     */
    public $customer;

    /**
     * @var string|null
     */
    public $cash;

    /**
     * @var string|null
     */
    public $receiptNumber;

    /**
     * @var Date
     */
    public $date;

    /**
     * @var ReceiptStatus
     */
    public $status;

    /**
     * @var Admin
     */
//    public $assignedTo;

    /**
     * @var string|null
     */
    public $totalReceived;

    /**
     * @var string|null
     */
    public $amountDue;

    /**
     * @var string|null
     */
    public $balanceDue;

    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     * @throws InvalidPropertyDefinitionException
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->customer)->asObject(Customer::class);
        $class->property($this->cash)->nullable()->asString();
        $class->property($this->receiptNumber)->nullable()->asString();
        $class->property($this->date)->asObject(Date::class);
        $class->property($this->status)->asObject(ReceiptStatus::class);
//        $class->property($this->assignedTo)->asObject(Admin::class);
        $class->property($this->totalReceived)->nullable()->asString();
        $class->property($this->amountDue)->nullable()->asString();
        $class->property($this->balanceDue)->nullable()->asString();

    }
}
