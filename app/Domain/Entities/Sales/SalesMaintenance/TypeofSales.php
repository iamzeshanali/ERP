<?php declare(strict_types = 1);

namespace App\Domain\Entities\Sales\SalesMaintenance;

use Dms\Common\Structure\Web\Html;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Model\Object\InvalidPropertyDefinitionException;

class TypeofSales extends Entity
{

    const CODE = 'code';
    const DESCRIPTION = 'description';
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
        $class->property($this->code)->asInt();
        $class->property($this->description)->asObject(Html::class);
        $class->property($this->inActive)->asBool();
    }

}
