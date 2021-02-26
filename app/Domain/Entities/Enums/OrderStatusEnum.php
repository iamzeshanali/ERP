<?php
namespace App\Domain\Entities\Enums;

use Dms\Core\Model\Object\Enum;
use Dms\Core\Model\Object\PropertyTypeDefiner;

class OrderStatusEnum extends Enum
{
    const PAID = 'paid';
    const PROCESS_ORDER = 'processOrder';
    const COMPLETE_ORDER = 'completeOrder';
    const REFUNDED = 'refunded';
    const UNPAID = 'unpaid';

    /*
     * @return array */
    public static function getNamedMap ()
    {
        return [
            OrderStatusEnum::PAID => 'paid',
            OrderStatusEnum::PROCESS_ORDER => 'processOrder',
            OrderStatusEnum::COMPLETE_ORDER => 'completeOrder',
            OrderStatusEnum::REFUNDED => 'refunded',
            OrderStatusEnum::UNPAID => 'unpaid',
        ];
    }

    /*
     * @param PropertyTypeDefiner $values
     * */
    protected function defineEnumValues(PropertyTypeDefiner $values)
    {
       $values->asString();
    }

    /**
     * @return DiscountTypeEnum
     * @throws InvalidEnumValueException
     */
    public static function paid () : self{
        return new self(self::PAID);
    }

    /**
     * @return DiscountTypeEnum
     * @throws InvalidEnumValueException
     */
    public static function processOrder () : self{
        return new self(self::PROCESS_ORDER);
    }

    /**
     * @return DiscountTypeEnum
     * @throws InvalidEnumValueException
     */
    public static function completeOrder () : self{
        return new self(self::COMPLETE_ORDER);
    }

    /**
     * @return DiscountTypeEnum
     * @throws InvalidEnumValueException
     */
    public static function refunded () : self{
        return new self(self::REFUNDED);
    }

    /**
     * @return DiscountTypeEnum
     * @throws InvalidEnumValueException
     */
    public static function unpaid () : self{
        return new self(self::UNPAID);
    }
}
