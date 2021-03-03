<?php


namespace App\Domain\Entities\Sales;


use App\Domain\Entities\Enums\Status;
use Dms\Common\Structure\Web\EmailAddress;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;

class SalesRepresentative extends Entity
{
    const CODE = 'code';
    const NAME = 'name';
    const PHONE = 'phone';
    const CELL = 'cell';
    const EMAIL = 'email';
//    const CUSTOMER = 'customer';
    const STATUS = 'status';

    /**
     * @var string|null
     */
    public $code;

    /**
     * @var string|null
     */
    public $name;

    /**
     * @var string|null
     */
    public $phone;

    /**
     * @var string|null
     */
    public $cell;

    /**
     * @var EmailAddress|null
     */
    public $email;

//    /**
//     * @var Customer|null
//     */
//    public $customer;

    /**
     * @var Status|null
     */
    public $status;


    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     * @throws InvalidPropertyDefinitionException
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->code)->nullable()->asString();
        $class->property($this->name)->nullable()->asString();
        $class->property($this->phone)->nullable()->asString();
        $class->property($this->cell)->nullable()->asString();
        $class->property($this->email)->nullable()->asObject(EmailAddress::class);
//        $class->property($this->customer)->nullable()->asObject(Customer::class);
        $class->property($this->status)->nullable()->asObject(Status::class);
    }
}