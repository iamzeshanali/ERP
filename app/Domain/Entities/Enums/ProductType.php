<?php


namespace App\Domain\Entities\Enums;


use Dms\Core\Model\Object\Enum;
use Dms\Core\Model\Object\InvalidEnumValueException;
use Dms\Core\Model\Object\PropertyTypeDefiner;

class ProductType extends Enum
{

    const PRODUCT = 'product';
    const SERVICE = 'service';


    /**
     * @return array
     */
    public static function getNamedMap()
    {
        return [
            ProductType::PRODUCT=> 'Product',
            ProductType::SERVICE=> 'Service',

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
     * @return ProductType
     * @throws InvalidEnumValueException
     */
    public static function product () : self{
        return new self(self::PRODUCT);
    }

    /**
     * @return ProductType
     * @throws InvalidEnumValueException
     */
    public static function service () : self{
        return new self(self::SERVICE);
    }
}