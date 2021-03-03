<?php


namespace App\Domain\Entities\Sales;


use App\Domain\Entities\Enums\Status;
use App\Domain\Entities\Financial\PaymentTerms;
use Dms\Common\Structure\Web\EmailAddress;
use Dms\Common\Structure\Web\Url;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;

class PreferredVendor extends Entity
{
    const VENDOR_NUMBER = 'vendorNumber';
    const NAME = 'name';
    const ADDRESS_LINE_1 = 'addressLine1';
    const ADDRESS_LINE_2 = 'addressLine2';
    const STATE = 'state';
    const ZIP = 'zip';
    const CITY = 'city';
    const COUNTRY = 'country';
    const PHONE = 'phone';
    const EMAIL = 'email';
    const WEBSITE = 'website';
    const PAYMENT_TERMS = 'paymentTerms';
    const LICENSE_NUMBER = 'licenseNumber';
    const STATUS = 'status';

    /**
     * @var string
     */
    public $vendorNumber;

    /**
     * @var string
     */
    public $name;

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
     * @var string|null
     */
    public $phone;

    /**
     * @var EmailAddress|null
     */
    public $email;

    /**
     * @var Url|null
     */
    public $website;

    /**
     * @var PaymentTerms|null
     */
    public $paymentTerms;

    /**
     * @var string|null
     */
    public $licenseNumber;

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
        $class->property($this->vendorNumber)->nullable()->asString();
        $class->property($this->name)->nullable()->asString();
        $class->property($this->addressLine1)->nullable()->asString();
        $class->property($this->addressLine2)->nullable()->asString();
        $class->property($this->state)->nullable()->asString();
        $class->property($this->zip)->nullable()->asString();
        $class->property($this->city)->nullable()->asString();
        $class->property($this->country)->nullable()->asString();
        $class->property($this->phone)->nullable()->asString();
        $class->property($this->email)->nullable()->asObject(EmailAddress::class);
        $class->property($this->website)->nullable()->asObject(Url::class);
        $class->property($this->paymentTerms)->nullable()->asObject(PaymentTerms::class);
        $class->property($this->licenseNumber)->nullable()->asString();
        $class->property($this->status)->nullable()->asObject(Status::class);
    }
}