<?php


namespace App\Domain\Entities\Enums;


use Dms\Core\Model\Object\Enum;
use Dms\Core\Model\Object\InvalidEnumValueException;
use Dms\Core\Model\Object\PropertyTypeDefiner;
use SebastianBergmann\CodeUnitReverseLookup\Wizard;

class Units extends Enum
{

    const OZ = 'oz';
    const ML = 'ml';
    const PINTS = 'pints';
    const QUARS = 'quars';
    const LITER = 'liter';
    const GALLON = 'gallon';


    /**
     * @return array
     */
    public static function getNamedMap()
    {
        return [
            Units::OZ=> 'oz',
            Units::ML=> 'ml',
            Units::PINTS=> 'pints',
            Units::QUARS=> 'quars',
            Units::LITER=> 'liter',
            Units::GALLON=> 'gallon',

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
     * @return Units
     * @throws InvalidEnumValueException
     */
    public static function oz () : self{
        return new self(self::OZ);
    }

    /**
     * @return Units
     * @throws InvalidEnumValueException
     */
    public static function ml () : self{
        return new self(self::ML);
    }

    /**
     * @return Units
     * @throws InvalidEnumValueException
     */
    public static function pints () : self{
        return new self(self::PINTS);
    }

    /**
     * @return Units
     * @throws InvalidEnumValueException
     */
    public static function quars () : self{
        return new self(self::QUARS);
    }

    /**
     * @return Units
     * @throws InvalidEnumValueException
     */
    public static function liter () : self{
        return new self(self::LITER);
    }

    /**
     * @return Units
     * @throws InvalidEnumValueException
     */
    public static function gallon () : self{
        return new self(self::GALLON);
    }
}