<?php


namespace App\Domain\Entities\Enums;


use Dms\Core\Model\Object\Enum;
use Dms\Core\Model\Object\InvalidEnumValueException;
use Dms\Core\Model\Object\PropertyTypeDefiner;

class ReceiptStatus extends Enum
{

    const DRAFT = 'draft';
    const CHECKING = 'checking';
    const FINALIZED = 'finalized';
    const CANCEL = 'cancel';


    /**
     * @return array
     */
    public static function getNamedMap()
    {
        return [
            ReceiptStatus::DRAFT=> 'Draft',
            ReceiptStatus::CHECKING=> 'checking',
            ReceiptStatus::FINALIZED=> 'Finalized',
            ReceiptStatus::CANCEL=> 'Cancel',

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
     * @return ReceiptStatus
     * @throws InvalidEnumValueException
     */
    public static function draft () : self{
        return new self(self::DRAFT);
    }

    /**
     * @return ReceiptStatus
     * @throws InvalidEnumValueException
     */
    public static function checking () : self{
        return new self(self::CHECKING);
    }

    /**
     * @return ReceiptStatus
     * @throws InvalidEnumValueException
     */
    public static function finalized () : self{
        return new self(self::FINALIZED);
    }

    /**
     * @return ReceiptStatus
     * @throws InvalidEnumValueException
     */
    public static function cancel () : self{
        return new self(self::CANCEL);
    }
}