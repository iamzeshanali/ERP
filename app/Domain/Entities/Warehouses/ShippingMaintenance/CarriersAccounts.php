<?php


namespace App\Domain\Entities\Warehouses\ShippingMaintenance;


use Dms\Common\Structure\Money\Money;
use Dms\Common\Structure\Web\Html;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;

class CarriersAccounts extends Entity
{
    const ACCOUNT_NO = 'accountNo';
    const CARRIER_NAME = 'carrierName';
    const CONTACT_NAME = 'contactName';
    const COMPANY_NAME = 'companyName';
    const ADDRESS_1 = 'address1';
    const ADDRESS_2 = 'address2';
    const CITY = 'city';
    const STATE = 'state';
    const ZIP = 'zip';
    const COUNTRY = 'country';
    const INACTIVE = 'inActive';

    /**
     * @var string
     */
    public $accountNo;
    /**
     * @var string
     */
    public $carrierName;
    /**
     * @var string
     */
    public $contactName;
    /**
     * @var string
     */
    public $companyName;
    /**
     * @var string
     */
    public $address1;

    /**
     * @var string
     */
    public $address2;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $state;

    /**
     * @var number
     */
    public $zip;

    /**
     * @var string
     */
    public $country;
    /**
     * @var Boolean
     */
    public $inActive;

    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     * @throws InvalidPropertyDefinitionException
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->accountNo)->asString();
        $class->property($this->carrierName)->asString();
        $class->property($this->contactName)->asString();
        $class->property($this->companyName)->asString();
        $class->property($this->address1)->asString();
        $class->property($this->address2)->nullable()->asString();
        $class->property($this->city)->asString();
        $class->property($this->state)->asString();
        $class->property($this->zip)->asInt();
        $class->property($this->country)->nullable()->asString();
        $class->property($this->inActive)->asBool();
    }
}
