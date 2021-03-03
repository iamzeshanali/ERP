<?php


namespace App\Domain\Entities\Enums;


use Dms\Core\Model\Object\Enum;
use Dms\Core\Model\Object\InvalidEnumValueException;
use Dms\Core\Model\Object\PropertyTypeDefiner;

class PurchaseOrderStatus extends Enum
{

    const DRAFT = 'draft';
    const IN_PROGRESS = 'inProgress';
    const ALLOW_RECEIVE = 'allowReceive';
    const CANCEL = 'cancel';


    /**
     * @return array
     */
    public static function getNamedMap()
    {
        return [
            PurchaseOrderStatus::DRAFT=> 'Draft',
            PurchaseOrderStatus::ALLOW_RECEIVE=> 'Allow Receive',
            PurchaseOrderStatus::IN_PROGRESS=> 'In Progress',
            PurchaseOrderStatus::CANCEL=> 'Cancel',

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
    public static function allowReceive () : self{
        return new self(self::ALLOW_RECEIVE);
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