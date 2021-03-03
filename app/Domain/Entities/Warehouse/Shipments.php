<?php


namespace App\Domain\Entities\Warehouse;


use Dms\Common\Structure\Web\Html;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;

class Shipments extends Entity
{

    const SEASON = 'season';
    const SHIPMENT_CODE = 'shipmentCode';
    const DESCRIPTION = 'description';

    /**
     * @var string|null
     */
    public $season;

    /**
     * @var string|null
     */
    public $shipmentCode;

    /**
     * @var Html|null
     */
    public $description;


    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     * @throws InvalidPropertyDefinitionException
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->season)->nullable()->asString();
        $class->property($this->shipmentCode)->nullable()->asString();
        $class->property($this->description)->nullable()->asObject(Html::class);
    }
}