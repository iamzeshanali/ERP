<?php


namespace App\Domain\Entities\Inventory;


use App\Domain\Entities\Enums\Status;
use Dms\Common\Structure\Web\Html;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;

class CasePack extends Entity
{
    const CODE = 'code';
    const DESCRIPTION = 'description';
    const UNITS_PER_PACK = 'unitsPerPack';
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
    public $unitsPerPack;

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
        $class->property($this->description)->nullable()->asObject(Html::class);
        $class->property($this->unitsPerPack)->nullable()->asString();
        $class->property($this->status)->nullable()->asObject(Status::class);
    }
}