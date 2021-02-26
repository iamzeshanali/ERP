<?php


namespace App\Domain\Entities\Enums;


use Dms\Core\Model\Object\Enum;
use Dms\Core\Model\Object\InvalidEnumValueException;
use Dms\Core\Model\Object\PropertyTypeDefiner;

class StockStatusEnum extends Enum
{
    const OUT_OF_STOCK = 'outOfStock';
    const IN_STOCK = 'inStock';

    /**
     * @return array
     */
    public static function getNamedMap()
    {
        return [
            StockStatusEnum::OUT_OF_STOCK=> 'outOfStock',
            StockStatusEnum::IN_STOCK=> 'inStock',

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
     * @return StockStatusEnum
     * @throws InvalidEnumValueException
     */
    public static function outOfStock () : self{
        return new self(self::OUT_OF_STOCK);
    }

    /**
     * @return StockStatusEnum
     * @throws InvalidEnumValueException
     */
    public static function inStock () : self{
        return new self(self::IN_STOCK);
    }
}
