<?php


namespace App\Domain\Entities\Enums;


use Dms\Core\Model\Object\Enum;
use Dms\Core\Model\Object\InvalidEnumValueException;
use Dms\Core\Model\Object\PropertyTypeDefiner;

class ProductStatus extends Enum
{
    const IN_USE = 'inUse';
    const NOT_IN_USE = 'notInUse';
    const INACTIVE = 'inactive';


    /**
     * @return array
     */
    public static function getNamedMap()
    {
        return [

            ProductStatus::INACTIVE=> 'InActive',
            ProductStatus::IN_USE=> 'In Use',
            ProductStatus::NOT_IN_USE=> 'Not In Use',

        ];
    }

    /**
     * Defines the type of the options contained within the enum.
     *
     * @param PropertyTypeDefiner $values
     *
     * @return void
     */
    protected function defineEnumValues(PropertyTypeDefiner $values)
    {
        $values->asString();
    }

    /**
     * @return ProductStatus
     * @throws InvalidEnumValueException
     */
    public static function inUse () : self{
        return new self(self::IN_USE);
    }

    /**
     * @return ProductStatus
     * @throws InvalidEnumValueException
     */
    public static function inActive () : self{
        return new self(self::INACTIVE);
    }

    /**
     * @return ProductStatus
     * @throws InvalidEnumValueException
     */
    public static function NotInUse () : self{
        return new self(self::NOT_IN_USE);
    }

}