<?php


namespace App\Domain\Entities\Warehouses\ShippingMaintenance;

use Dms\Common\Structure\DateTime\Date;
use Dms\Common\Structure\Web\Html;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use phpDocumentor\Reflection\Types\Boolean;

class Shipments extends Entity
{
    const CODE = 'code';
    const DESCRIPTION    = 'description';
    const CARRIER_DETAIL     = 'carrierDetail';

    /**
     * @var string
     */
    public $code;
    /**
     * @var Date
     */
    public $description;
    /**
     * @var Boolean
     */
    public $carrierDetail;


    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->code)->asString();
        $class->property($this->description)->asObject(Html::class);
        $class->property($this->carrierDetail)->asBool();
    }

}
