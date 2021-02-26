<?php
namespace App\Domain\Entities\Enums;

use Dms\Core\Model\Object\Enum;
use Dms\Core\Model\Object\PropertyTypeDefiner;

class CustomerStatusEnum extends Enum
{
    const ACTIVE =  'Active';
    const INACTIVE =  'Inactive';
    const POTENTIAL =  'Potential';
    const RESTRICTED=  'Restricted';
    const WARNED =  'Warned';

    /**
     * @return array
     */
    public static function getNamedMap()
    {
        return [
            CustomerStatusEnum::ACTIVE => 'Active',
            CustomerStatusEnum::INACTIVE => 'Inactive',
            CustomerStatusEnum::POTENTIAL => 'Potential',
            CustomerStatusEnum::RESTRICTED => 'Restricted',
            CustomerStatusEnum::WARNED => 'Warned'
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
    public static function Active() :self {
        return new self(self::ACTIVE);
    }

    /*
     * @return DiscountTypeEnum
     * @throws InvalidEnumValueException
     * */
    public static function Inactive() :self {
        return new self(self::INACTIVE);
    }
    /*
     * @return DiscountTypeEnum
     * @throws InvalidEnumValueException
     * */
    public static function Potential() :self {
        return new self(self::ACTIVE);
    }

    /*
     * @return DiscountTypeEnum
     * @throws InvalidEnumValueException
     * */
    public static function Restricted() :self {
        return new self(self::RESTRICTED);
    }
    /*
     * @return DiscountTypeEnum
     * @throws InvalidEnumValueException
     * */
    public static function Warned() :self {
        return new self(self::WARNED);
    }

}
