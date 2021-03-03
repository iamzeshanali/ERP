<?php


namespace App\Domain\Entities\Sales;


use App\Domain\Entities\Enums\CustomerStatus;
use App\Domain\Entities\Financial\PaymentTerms;
use Dms\Common\Structure\Web\EmailAddress;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;
use Dms\Core\Persistence\Db\Schema\Type\Boolean;

class Customer extends Entity
{
    const CUSTOMER_NAME = 'customerName';
    const CUSTOMER_NUMBER = 'customerNumber';
    const CUSTOMER_EMAIL = 'customerEmail';
    const CUSTOMER_STATUS = 'customerStatus';
    const SALES_REPRESENTATIVE = 'salesRepresentative';
    const ADDRESS_LINE_1 = 'addressLine1';
    const ADDRESS_LINE_2 = 'addressLine2';
    const STATE = 'state';
    const ZIP = 'zip';
    const CITY = 'city';
    const COUNTRY = 'country';

    // if shipping is different

    const SHIPPING_ADDRESS_LINE_1 = 'shippingAddressLine1';
    const SHIPPING_ADDRESS_LINE_2 = 'shippingAddressLine2';
    const SHIPPING_STATE = 'shippingState';
    const SHIPPING_ZIP = 'shippingZip';
    const SHIPPING_CITY = 'shippingCity';
    const SHIPPING_COUNTRY = 'shippingCountry';

    const IS_SHIPPING_SAME = 'isShippingSame';
    const PHONE = 'phone';
    const BEV_LICENCE_NUMBER = 'bevLicenseNumber';
    const PAYMENT_TERMS = 'paymentTerms';
    const NUMBER_OF_PALLETS = 'numberOfPallets';

    /**
     * @var string|null
     */
    public $customerName;

    /**
     * @var string|null
     */
    public $customerNumber;

    /**
     * @var string|null
     */
    public $email;

    /**
     * @var CustomerStatus|null
     */
    public $customerStatus;

    /**
     * @var SalesRepresentative
     */
    public $salesRepresentative;

    /**
     * @var string|null
     */
    public $addressLine1;

    /**
     * @var string|null
     */
    public $addressLine2;

    /**
     * @var string|null
     */
    public $state;

    /**
     * @var string|null
     */
    public $zip;

    /**
     * @var string|null
     */
    public $city;

    /**
     * @var string|null
     */
    public $country;

    /**
     * @var Boolean|null
     */
    public $isShippingSame;

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
     * @var string|null
     */
    public $phone;

    /**
     * @var string|null
     */
    public $bevLicenceNumber;

    /**
     * @var PaymentTerms|null
     */
    public $paymentTerms;

    /**
     * @var string|null
     */
    public $numberOfPallets;


    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     * @throws InvalidPropertyDefinitionException
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->customerName)->nullable()->asString();
        $class->property($this->customerNumber)->nullable()->asString();
        $class->property($this->customerStatus)->nullable()->asObject(CustomerStatus::class);
        $class->property($this->email)->nullable()->asObject(EmailAddress::class);
        $class->property($this->salesRepresentative)->asObject(SalesRepresentative::class);
        $class->property($this->addressLine1)->nullable()->asString();
        $class->property($this->addressLine2)->nullable()->asString();
        $class->property($this->state)->nullable()->asString();
        $class->property($this->city)->nullable()->asString();
        $class->property($this->zip)->nullable()->asString();
        $class->property($this->country)->nullable()->asString();
        $class->property($this->isShippingSame)->nullable()->asBool();
        $class->property($this->shippingAddressLine1)->nullable()->asString();
        $class->property($this->shippingAddressLine2)->nullable()->asString();
        $class->property($this->shippingState)->nullable()->asString();
        $class->property($this->shippingCity)->nullable()->asString();
        $class->property($this->shippingZip)->nullable()->asString();
        $class->property($this->shippingCountry)->nullable()->asString();
        $class->property($this->phone)->nullable()->asString();
        $class->property($this->bevLicenceNumber)->nullable()->asString();
        $class->property($this->paymentTerms)->nullable()->asObject(PaymentTerms::class);
        $class->property($this->numberOfPallets)->nullable()->asString();

    }
}