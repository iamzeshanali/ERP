<?php


namespace App\Domain\Entities\Enums;


use Dms\Core\Model\Object\Enum;
use Dms\Core\Model\Object\InvalidEnumValueException;
use Dms\Core\Model\Object\PropertyTypeDefiner;

class CustomerStatus extends Enum
{
    const POTENTIAL = 'potential';
    const ACTIVE = 'active';
    const RESTRICTED = 'restricted';
    const INACTIVE = 'inactive';


    /**
     * @return array
     */
    public static function getNamedMap()
    {
        return [
            CustomerStatus::POTENTIAL=> 'Potential',
            CustomerStatus::INACTIVE=> 'InActive',
            CustomerStatus::ACTIVE=> 'Active',
            CustomerStatus::RESTRICTED=> 'Restricted',

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
     * @return CustomerStatus
     * @throws InvalidEnumValueException
     */
    public static function active () : self{
        return new self(self::ACTIVE);
    }

    /**
     * @return CustomerStatus
     * @throws InvalidEnumValueException
     */
    public static function inActive () : self{
        return new self(self::INACTIVE);
    }

    /**
     * @return CustomerStatus
     * @throws InvalidEnumValueException
     */
    public static function potential () : self{
        return new self(self::POTENTIAL);
    }

    /**
     * @return CustomerStatus
     * @throws InvalidEnumValueException
     */
    public static function restricted () : self{
        return new self(self::RESTRICTED);
    }


}