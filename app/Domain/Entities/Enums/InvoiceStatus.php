<?php


namespace App\Domain\Entities\Enums;


use Dms\Core\Model\Object\Enum;
use Dms\Core\Model\Object\InvalidEnumValueException;
use Dms\Core\Model\Object\PropertyTypeDefiner;

class InvoiceStatus extends Enum
{

    const DRAFT = 'draft';
    const IN_PROGRESS = 'inProgress';
    const POSTED = 'posted';
    const CANCEL = 'cancel';


    /**
     * @return array
     */
    public static function getNamedMap()
    {
        return [
            InvoiceStatus::DRAFT=> 'Draft',
            InvoiceStatus::POSTED=> 'Posted',
            InvoiceStatus::IN_PROGRESS=> 'In Progress',
            InvoiceStatus::CANCEL=> 'Cancel',

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
     * @return InvoiceStatus
     * @throws InvalidEnumValueException
     */
    public static function draft () : self{
        return new self(self::DRAFT);
    }

    /**
     * @return InvoiceStatus
     * @throws InvalidEnumValueException
     */
    public static function posted () : self{
        return new self(self::POSTED);
    }

    /**
     * @return InvoiceStatus
     * @throws InvalidEnumValueException
     */
    public static function inProgress () : self{
        return new self(self::IN_PROGRESS);
    }

    /**
     * @return InvoiceStatus
     * @throws InvalidEnumValueException
     */
    public static function cancel () : self{
        return new self(self::CANCEL);
    }
}