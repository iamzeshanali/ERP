<?php declare(strict_types = 1);

namespace App\Domain\Entities\Sales\Customers;

use App\Domain\Entities\Enums\CustomerStatusEnum;
use Dms\Common\Structure\Web\EmailAddress;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;
use Ramsey\Uuid\Type\Integer;
u
class Customers extends Entity
{
    const NUMBER = 'number';
    const FIRST_NAME    = 'firstName';
    const LAST_NAME     = 'lastName';
    const STATUS = 'status';
    const SALES_REPRESENTATIVE = 'salesRepresentative';
    const TAX = 'tax';
    const ADDRESS = 'address';
    const CITY = 'city';
    const STATE = 'state';
    const ZIP = 'zip';
    const COUNTRY = 'country';
    const PHONE = 'phone';
    const FAX = 'fax';
    const EMAIL = 'email';
    const GROUP = 'group';

    /**
     * @var string
     */
    public $number;
    /**
     * @var string
     */
    public $firstName;
    /**
     * @var string
     */
    public $lastName;
    /**
     * @var CustomerStatusEnum
     */
    public $status;
    /**
     * @var string
     */
    public $salesRepresentative;
    /**
     * @var string
     */
    public $tax;
    /**
     * @var string
     */
    public $address;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $state;
    /**
     * @var Integer
     */
    public $zip;
    /**
     * @var string
     */
    public $country;
    /**
     * @var string
     */
    public $phone;
    /**
     * @var string
     */
    public $fax;
    /**
     * @var EmailAddress
     */
    public $email;
    /**
     * @var string
     */
    public $group;

    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     * @throws InvalidPropertyDefinitionException
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->number)->asString();
        $class->property($this->firstName)->asString();
        $class->property($this->lastName)->asString();
        $class->property($this->status)->asObject(CustomerStatusEnum::class);
        $class->property($this->salesRepresentative)->nullable()->asObject(SalesRepresentative::class);
        $class->property($this->tax)->asString();
        $class->property($this->address)->asString();
        $class->property($this->city)->asString();
        $class->property($this->state)->asString();
        $class->property($this->zip)->asInt();
        $class->property($this->country)->nullable()->asString();
        $class->property($this->phone)->nullable()->asString();
        $class->property($this->fax)->nullable()->asString();
        $class->property($this->email)->nullable()->asObject(EmailAddress::class);
        $class->property($this->group)->nullable()->asObject(CustomersGroups::class);

    }
}
