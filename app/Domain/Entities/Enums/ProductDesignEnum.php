<?php


namespace App\Domain\Entities\Enums;


use Dms\Core\Model\Object\Enum;
use Dms\Core\Model\Object\InvalidEnumValueException;
use Dms\Core\Model\Object\PropertyTypeDefiner;

class ProductDesignEnum extends Enum
{
    const DESIGN1 = 'design1';
    const DESIGN2 = 'design2';
    const DESIGN3 = 'design3';
    const DESIGN4 = 'design4';

    /**
     * @return array
     */
    public static function getNamedMap()
    {
        return [
            ProductDesignEnum::DESIGN1=> 'design1',
            ProductDesignEnum::DESIGN2=> 'design2',
            ProductDesignEnum::DESIGN3=> 'design3',
            ProductDesignEnum::DESIGN4=> 'design4',
//            ProductDesignEnum::COMPLETE_ORDER=> 'completeOrder',

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
     * @return ProductDesignEnum
     * @throws InvalidEnumValueException
     */
    public static function design1 () : self{
        return new self(self::DESIGN1);
    }

    /**
     * @return ProductDesignEnum
     * @throws InvalidEnumValueException
     */
    public static function design2 () : self{
        return new self(self::DESIGN2);
    }

    /**
     * @return ProductDesignEnum
     * @throws InvalidEnumValueException
     */
    public static function design3 () : self{
        return new self(self::DESIGN3);
    }

    /**
     * @return ProductDesignEnum
     * @throws InvalidEnumValueException
     */
    public static function design4 () : self{
        return new self(self::DESIGN4);
    }

//    /**
//     * @return ProductDesignEnum
//     * @throws InvalidEnumValueException
//     */
//    public static function completeOrder () : self{
//        return new self(self::COMPLETE_ORDER);
//    }
}
