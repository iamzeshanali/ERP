<?php


namespace App\Domain\Entities\Enums;


use Dms\Core\Model\Object\Enum;
use Dms\Core\Model\Object\InvalidEnumValueException;
use Dms\Core\Model\Object\PropertyTypeDefiner;

class Status extends Enum
{

    const ACTIVE = 'active';
    const INACTIVE = 'inactive';


    /**
     * @return array
     */
    public static function getNamedMap()
    {
        return [
            Status::ACTIVE=> 'Active',
            Status::INACTIVE=> 'InActive',

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
     * @return Status
     * @throws InvalidEnumValueException
     */
    public static function active () : self{
        return new self(self::ACTIVE);
    }

    /**
     * @return Status
     * @throws InvalidEnumValueException
     */
    public static function inactive () : self{
        return new self(self::INACTIVE);
    }
}