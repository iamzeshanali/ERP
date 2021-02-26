<?php
namespace App\Domain\Entities\Enums;


use Dms\Core\Model\Object\Enum;
use Dms\Core\Model\Object\PropertyTypeDefiner;

class  DiscountTypeEnum extends Enum {
    const PERCENTAGE = 'percentage';
    const DOLLAR_AMOUNT = 'dollarAmount';

    /**
     * @return array
     */
    public static function getNamedMap()
    {
        return [
            DiscountTypeEnum::PERCENTAGE => 'percentage',
            DiscountTypeEnum::DOLLAR_AMOUNT => 'dollarAmount'
        ];
    }

    /*
     * @param PropertyTypeDefiner $values
     * @return void
    */
    protected function defineEnumValues(PropertyTypeDefiner $values)
    {
        $values->asString();
    }
    /*
     * @return DiscountTypeEnum
     * @throws InvalidEnumValueException
     * */
    public static function percentage() :self {
        return new self(self::PERCENTAGE);
    }

    /*
     * @return DiscountTypeEnum
     * @throws InvalidEnumValueException
     * */
    public static function dollarAmount() :self {
        return new self(self::DOLLAR_AMOUNT);
    }
}
