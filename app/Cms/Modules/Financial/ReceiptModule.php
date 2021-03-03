<?php declare(strict_types = 1);

namespace App\Cms\Modules\Financial;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Financial\IReceiptRepository;
use App\Domain\Entities\Financial\Receipt;
use Dms\Common\Structure\Field;
use App\Domain\Services\Persistence\Sales\ICustomerRepository;
use App\Domain\Entities\Sales\Customer;
use App\Domain\Entities\Enums\ReceiptStatus;

/**
 * The receipt module.
 */
class ReceiptModule extends CrudModule
{
    /**
     * @var ICustomerRepository
     */
    protected $customerRepository;


    public function __construct(IReceiptRepository $dataSource, IAuthSystem $authSystem, ICustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
        parent::__construct($dataSource, $authSystem);
    }

    /**
     * Defines the structure of this module.
     *
     * @param CrudModuleDefinition $module
     */
    protected function defineCrudModule(CrudModuleDefinition $module)
    {
        $module->name('receipt');

        $module->labelObjects()->fromProperty(Receipt::CASH);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('customer', 'Customer')
                        ->entityFrom($this->customerRepository)
                        ->required()
                        ->labelledBy(Customer::CUSTOMER_NAME)
                )->bindToProperty(Receipt::CUSTOMER),
                //
                $form->field(
                    Field::create('cash', 'Cash')->string()
                )->bindToProperty(Receipt::CASH),
                //
                $form->field(
                    Field::create('receipt_number', 'Receipt Number')->string()
                )->bindToProperty(Receipt::RECEIPT_NUMBER),
                //
                $form->field(
                    Field::create('date', 'Date')->date()->required()
                )->bindToProperty(Receipt::DATE),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(ReceiptStatus::class, [
                        ReceiptStatus::DRAFT => 'Draft',
                        ReceiptStatus::CHECKING => 'Checking',
                        ReceiptStatus::FINALIZED => 'Finalized',
                        ReceiptStatus::CANCEL => 'Cancel',
                    ])->required()
                )->bindToProperty(Receipt::STATUS),
                //
                $form->field(
                    Field::create('total_received', 'Total Received')->string()
                )->bindToProperty(Receipt::TOTAL_RECEIVED),
                //
                $form->field(
                    Field::create('amount_due', 'Amount Due')->string()
                )->bindToProperty(Receipt::AMOUNT_DUE),
                //
                $form->field(
                    Field::create('balance_due', 'Balance Due')->string()
                )->bindToProperty(Receipt::BALANCE_DUE),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(Receipt::CUSTOMER)->to(Field::create('customer', 'Customer')
                ->entityFrom($this->customerRepository)
                ->required()
                ->labelledBy(Customer::CUSTOMER_NAME));
            $table->mapProperty(Receipt::CASH)->to(Field::create('cash', 'Cash')->string());
            $table->mapProperty(Receipt::RECEIPT_NUMBER)->to(Field::create('receipt_number', 'Receipt Number')->string());
            $table->mapProperty(Receipt::DATE)->to(Field::create('date', 'Date')->date()->required());
            $table->mapProperty(Receipt::STATUS)->to(Field::create('status', 'Status')->enum(ReceiptStatus::class, [
                ReceiptStatus::DRAFT => 'Draft',
                ReceiptStatus::CHECKING => 'Checking',
                ReceiptStatus::FINALIZED => 'Finalized',
                ReceiptStatus::CANCEL => 'Cancel',
            ])->required());
            $table->mapProperty(Receipt::TOTAL_RECEIVED)->to(Field::create('total_received', 'Total Received')->string());
            $table->mapProperty(Receipt::AMOUNT_DUE)->to(Field::create('amount_due', 'Amount Due')->string());
            $table->mapProperty(Receipt::BALANCE_DUE)->to(Field::create('balance_due', 'Balance Due')->string());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}