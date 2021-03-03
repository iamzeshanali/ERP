<?php


namespace App\Domain\Entities\Inventory;


use App\Domain\Entities\Enums\Status;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;

class Group extends Entity
{
    const CODE = 'code';
    const DESCRIPTION = 'description';
    const STATUS = 'status';

    /**
     * @var string
     */
    public $code;

    /**
     * @var string|null
     */
    public $description;

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
        $class->property($this->code)->asString();
        $class->property($this->description)->nullable()->asString();
        $class->property($this->status)->nullable()->asObject(Status::class);
    }
}