<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Financial;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Financial\Receipt;
use App\Domain\Entities\Sales\Customer;
use Dms\Common\Structure\DateTime\Persistence\DateMapper;

/**
 * The App\Domain\Entities\Financial\Receipt entity mapper.
 */
class ReceiptMapper extends EntityMapper
{
    /**
     * Defines the entity mapper
     *
     * @param MapperDefinition $map
     *A
     * @return void
     */
    protected function define(MapperDefinition $map)
    {
        $map->type(Receipt::class);
        $map->toTable('receipts');

        $map->idToPrimaryKey('id');

        $map->column('customer_id')->asUnsignedInt();
        $map->relation(Receipt::CUSTOMER)
            ->to(Customer::class)
            ->manyToOne()
            ->withRelatedIdAs('customer_id');

        /*$map->column('assigned_to_id')->asUnsignedInt();
        $map->relation(Receipt::ASSIGNED_TO)
            ->to(Admin::class)
            ->manyToOne()
            ->withRelatedIdAs('assigned_to_id');*/

        $map->property(Receipt::CASH)->to('cash')->nullable()->asVarchar(255);

        $map->property(Receipt::RECEIPT_NUMBER)->to('receipt_number')->nullable()->asVarchar(255);

        $map->embedded(Receipt::DATE)
            ->using(new DateMapper('date'));

        $map->enum(Receipt::STATUS)->to('status')->usingValuesFromConstants();

        $map->property(Receipt::TOTAL_RECEIVED)->to('total_received')->nullable()->asVarchar(255);

        $map->property(Receipt::AMOUNT_DUE)->to('amount_due')->nullable()->asVarchar(255);

        $map->property(Receipt::BALANCE_DUE)->to('balance_due')->nullable()->asVarchar(255);


    }
}
