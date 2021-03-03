<?php


namespace App\Domain\Entities\Warehouse;


use App\Domain\Entities\Enums\Status;
use Dms\Common\Structure\Web\Html;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;

class Warehouse extends Entity
{

    const CODE = 'code';
    const DESCRIPTION= 'description';
    const ADDRESS1 = 'address1';
    const ADDRESS2 = 'address2';
    const CITY = 'city';
    const COUNTRY = 'country';
    const STATE = 'state';
    const ZIP = 'zip';
    const STATUS = 'status';

    /**
     * @var string|null
     */
    public $code;

    /**
     * @var Html|null
     */
    public $description;

    /**
     * @var string|null
     */
    public $address1;

    /**
     * @var string|null
     */
    public $address2;

    /**
     * @var string|null
     */
    public $city;

    /**
     * @var string|null
     */
    public $state;

    /**
     * @var string|null
     */
    public $country;

    /**
     * @var string|null
     */
    public $zip;

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
        $class->property($this->address1)->nullable()->asString();
        $class->property($this->description)->nullable()->asObject(Html::class);
        $class->property($this->address2)->nullable()->asString();
        $class->property($this->city)->nullable()->asString();
        $class->property($this->state)->nullable()->asString();
        $class->property($this->country)->nullable()->asString();
        $class->property($this->zip)->nullable()->asString();
        $class->property($this->status)->nullable()->asObject(Status::class);

    }
}