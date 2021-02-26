<?php

namespace App\Domain\Entities\Warehouses;

use Dms\Common\Structure\Money\Money;
use Dms\Common\Structure\Web\Html;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;

class Warehouses extends Entity
{
    const CODE = 'code';
    const DESCRIPTION = 'description';
    const BRANCH = 'branch';
    const ADDRESS_1 = 'address1';
    const ADDRESS_2 = 'address2';
    const CITY = 'city';
    const STATE = 'state';
    const ZIP = 'zip';
    const COUNTRY = 'country';
    const INVENTORY_VALUED = 'inventoryValued';
    const INCLUDE_MRP = 'includeMrp';
    const SALES_WAREHOUSE = 'salesWarehouse';
    const BALANCE = 'balance';
    const INACTIVE = 'inActive';

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $branch;

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
    public $inventoryValued;

    /**
     * @var Boolean
     */
    public $includeMrp;

    /**
     * @var Boolean
     */
    public $salesWarehouse;

    /**
     * @var number
     */
    public $balance;

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
        $class->property($this->code)->asString();
        $class->property($this->description)->asObject(Html::class);
        $class->property($this->branch)->nullable()->asString();
        $class->property($this->address1)->asString();
        $class->property($this->address2)->nullable()->asString();
        $class->property($this->city)->asString();
        $class->property($this->state)->asString();
        $class->property($this->zip)->asInt();
        $class->property($this->country)->nullable()->asString();
        $class->property($this->inventoryValued)->asBool();
        $class->property($this->includeMrp)->asBool();
        $class->property($this->salesWarehouse)->asBool();
        $class->property($this->balance)->asObject(Money::class);
        $class->property($this->inActive)->asBool();
    }


}
