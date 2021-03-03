<?php


namespace App\Domain\Entities\Inventory;


use App\Domain\Entities\Enums\Status;
use App\Domain\Entities\Enums\Units;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;

class Uom extends Entity
{
    const CODE = 'code';
    const QUANTITY = 'quantity';
    const UNIT = 'unit';
    const STATUS = 'status';

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $quantity;

    /**
     * @var Units|null
     */
    public $unit;

    /**
     * @var Status
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
        $class->property($this->code)->asString();
        $class->property($this->quantity)->asString();
        $class->property($this->unit)->asObject(Units::class);
        $class->property($this->status)->asObject(Status::class);
    }
}