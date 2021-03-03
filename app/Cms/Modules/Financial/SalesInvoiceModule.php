<?php declare(strict_types = 1);

namespace App\Cms\Modules\Financial;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Financial\ISalesInvoiceRepository;
use App\Domain\Entities\Financial\SalesInvoice;
use Dms\Common\Structure\Field;
use App\Domain\Services\Persistence\Sales\ICustomerRepository;
use App\Domain\Entities\Sales\Customer;
use App\Domain\Entities\Enums\InvoiceStatus;
use App\Domain\Services\Persistence\Sales\ISalesRepresentativeRepository;
use App\Domain\Entities\Sales\SalesRepresentative;
use App\Domain\Services\Persistence\Warehouse\IShipmentsRepository;
use App\Domain\Entities\Warehouse\Shipments;
use App\Domain\Services\Persistence\Financial\IPaymentTermsRepository;
use App\Domain\Entities\Financial\PaymentTerms;
use App\Domain\Services\Persistence\Warehouse\IWarehouseRepository;
use App\Domain\Entities\Warehouse\Warehouse;
use App\Domain\Services\Persistence\Financial\ISalesInvoiceDetailRepository;
use App\Domain\Entities\Financial\SalesInvoiceDetail;

/**
 * The sales-invoice module.
 */
class SalesInvoiceModule extends CrudModule
{
    /**
     * @var ICustomerRepository
     */
    protected $customerRepository;

    /**
     * @var ISalesRepresentativeRepository
     */
    protected $salesRepresentativeRepository;

    /**
     * @var IShipmentsRepository
     */
    protected $shipmentsRepository;

    /**
     * @var IPaymentTermsRepository
     */
    protected $paymentTermsRepository;

    /**
     * @var IWarehouseRepository
     */
    protected $warehouseRepository;

    /**
     * @var ISalesInvoiceDetailRepository
     */
    protected $salesInvoiceDetailRepository;


    public function __construct(ISalesInvoiceRepository $dataSource, IAuthSystem $authSystem, ICustomerRepository $customerRepository, ISalesRepresentativeRepository $salesRepresentativeRepository, IShipmentsRepository $shipmentsRepository, IPaymentTermsRepository $paymentTermsRepository, IWarehouseRepository $warehouseRepository, ISalesInvoiceDetailRepository $salesInvoiceDetailRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->salesRepresentativeRepository = $salesRepresentativeRepository;
        $this->shipmentsRepository = $shipmentsRepository;
        $this->paymentTermsRepository = $paymentTermsRepository;
        $this->warehouseRepository = $warehouseRepository;
        $this->salesInvoiceDetailRepository = $salesInvoiceDetailRepository;
        parent::__construct($dataSource, $authSystem);
    }

    /**
     * Defines the structure of this module.
     *
     * @param CrudModuleDefinition $module
     */
    protected function defineCrudModule(CrudModuleDefinition $module)
    {
        $module->name('sales-invoice');

        $module->labelObjects()->fromProperty(SalesInvoice::INVOICE_NUMBER);

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
                )->bindToProperty(SalesInvoice::CUSTOMER),
                //
                $form->field(
                    Field::create('date', 'Date')->date()->required()
                )->bindToProperty(SalesInvoice::DATE),
                //
                $form->field(
                    Field::create('invoice_number', 'Invoice Number')->string()->required()
                )->bindToProperty(SalesInvoice::INVOICE_NUMBER),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(InvoiceStatus::class, [
                        InvoiceStatus::DRAFT => 'Draft',
                        InvoiceStatus::IN_PROGRESS => 'In Progress',
                        InvoiceStatus::POSTED => 'Posted',
                        InvoiceStatus::CANCEL => 'Cancel',
                    ])->required()
                )->bindToProperty(SalesInvoice::STATUS),
                //
                $form->field(
                    Field::create('shipping_address_line1', 'Shipping Address Line1')->string()
                )->bindToProperty(SalesInvoice::SHIPPING_ADDRESS_LINE_1),
                //
                $form->field(
                    Field::create('shipping_address_line2', 'Shipping Address Line2')->string()
                )->bindToProperty(SalesInvoice::SHIPPING_ADDRESS_LINE_2),
                //
                $form->field(
                    Field::create('shipping_state', 'Shipping State')->string()
                )->bindToProperty(SalesInvoice::SHIPPING_STATE),
                //
                $form->field(
                    Field::create('shipping_zip', 'Shipping Zip')->string()
                )->bindToProperty(SalesInvoice::SHIPPING_ZIP),
                //
                $form->field(
                    Field::create('shipping_city', 'Shipping City')->string()
                )->bindToProperty(SalesInvoice::SHIPPING_CITY),
                //
                $form->field(
                    Field::create('shipping_country', 'Shipping Country')->string()
                )->bindToProperty(SalesInvoice::SHIPPING_COUNTRY),
                //
                $form->field(
                    Field::create('sales_rep', 'Sales Rep')
                        ->entityFrom($this->salesRepresentativeRepository)
                        ->required()
                        ->labelledBy(SalesRepresentative::NAME)
                )->bindToProperty(SalesInvoice::SALES_REP),
                //
                $form->field(
                    Field::create('shipping_code', 'Shipping Code')
                        ->entityFrom($this->shipmentsRepository)
                        ->required()
                        ->labelledBy(/* FIXME: */ Shipments::ID)
                )->bindToProperty(SalesInvoice::SHIPPING_CODE),
                //
                $form->field(
                    Field::create('payment_terms', 'Payment Terms')
                        ->entityFrom($this->paymentTermsRepository)
                        ->required()
                        ->labelledBy(/* FIXME: */ PaymentTerms::ID)
                )->bindToProperty(SalesInvoice::PAYMENT_TERMS),
                //
                $form->field(
                    Field::create('warehouse', 'Warehouse')
                        ->entityFrom($this->warehouseRepository)
                        ->required()
                        ->labelledBy(/* FIXME: */ Warehouse::ID)
                )->bindToProperty(SalesInvoice::WAREHOUSE),
                //
                $form->field(
                    Field::create('profit_in_percent', 'Profit In Percent')->string()
                )->bindToProperty(SalesInvoice::PROFIT_IN_PERCENT),
                //
                $form->field(
                    Field::create('profit_in_dollar', 'Profit In Dollar')->string()
                )->bindToProperty(SalesInvoice::PROFIT_IN_DOLLAR),
                //
                $form->field(
                    Field::create('total', 'Total')->string()
                )->bindToProperty(SalesInvoice::TOTAL),
                //
                $form->field(
                    Field::create('discount_in_percent', 'Discount In Percent')->string()
                )->bindToProperty(SalesInvoice::DISCOUNT_IN_PERCENT),
                //
                $form->field(
                    Field::create('discount_in_dollar', 'Discount In Dollar')->string()
                )->bindToProperty(SalesInvoice::DISCOUNT_IN_DOLLAR),
                //
                $form->field(
                    Field::create('total_after_discount', 'Total After Discount')->string()
                )->bindToProperty(SalesInvoice::TOTAL_AFTER_DISCOUNT),
                //
                $form->field(
                    Field::create('total_tax', 'Total Tax')->string()
                )->bindToProperty(SalesInvoice::TOTAL_TAX),
                //
                $form->field(
                    Field::create('final_price', 'Final Price')->string()
                )->bindToProperty(SalesInvoice::FINAL_PRICE),
                //
                $form->field(
                    Field::create('sales_invoice_detail', 'Sales Invoice Detail')
                        ->entitiesFrom($this->salesInvoiceDetailRepository)
                        ->labelledBy(/* FIXME: */ SalesInvoiceDetail::ID)
                        ->mapToCollection(SalesInvoiceDetail::collectionType())
                )->bindToProperty(SalesInvoice::SALES_INVOICE_DETAIL),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(SalesInvoice::CUSTOMER)->to(Field::create('customer', 'Customer')
                ->entityFrom($this->customerRepository)
                ->required()
                ->labelledBy(Customer::CUSTOMER_NAME));
            $table->mapProperty(SalesInvoice::DATE)->to(Field::create('date', 'Date')->date()->required());
            $table->mapProperty(SalesInvoice::INVOICE_NUMBER)->to(Field::create('invoice_number', 'Invoice Number')->string()->required());
            $table->mapProperty(SalesInvoice::STATUS)->to(Field::create('status', 'Status')->enum(InvoiceStatus::class, [
                InvoiceStatus::DRAFT => 'Draft',
                InvoiceStatus::IN_PROGRESS => 'In Progress',
                InvoiceStatus::POSTED => 'Posted',
                InvoiceStatus::CANCEL => 'Cancel',
            ])->required());
            $table->mapProperty(SalesInvoice::SHIPPING_ADDRESS_LINE_1)->to(Field::create('shipping_address_line1', 'Shipping Address Line1')->string());
            $table->mapProperty(SalesInvoice::SHIPPING_ADDRESS_LINE_2)->to(Field::create('shipping_address_line2', 'Shipping Address Line2')->string());
            $table->mapProperty(SalesInvoice::SHIPPING_STATE)->to(Field::create('shipping_state', 'Shipping State')->string());
            $table->mapProperty(SalesInvoice::SHIPPING_ZIP)->to(Field::create('shipping_zip', 'Shipping Zip')->string());
            $table->mapProperty(SalesInvoice::SHIPPING_CITY)->to(Field::create('shipping_city', 'Shipping City')->string());
            $table->mapProperty(SalesInvoice::SHIPPING_COUNTRY)->to(Field::create('shipping_country', 'Shipping Country')->string());
            $table->mapProperty(SalesInvoice::SALES_REP)->to(Field::create('sales_rep', 'Sales Rep')
                ->entityFrom($this->salesRepresentativeRepository)
                ->required()
                ->labelledBy(SalesRepresentative::NAME));
            $table->mapProperty(SalesInvoice::SHIPPING_CODE)->to(Field::create('shipping_code', 'Shipping Code')
                ->entityFrom($this->shipmentsRepository)
                ->required()
                ->labelledBy(/* FIXME: */ Shipments::ID));
            $table->mapProperty(SalesInvoice::PAYMENT_TERMS)->to(Field::create('payment_terms', 'Payment Terms')
                ->entityFrom($this->paymentTermsRepository)
                ->required()
                ->labelledBy(/* FIXME: */ PaymentTerms::ID));
            $table->mapProperty(SalesInvoice::WAREHOUSE)->to(Field::create('warehouse', 'Warehouse')
                ->entityFrom($this->warehouseRepository)
                ->required()
                ->labelledBy(/* FIXME: */ Warehouse::ID));
            $table->mapProperty(SalesInvoice::PROFIT_IN_PERCENT)->to(Field::create('profit_in_percent', 'Profit In Percent')->string());
            $table->mapProperty(SalesInvoice::PROFIT_IN_DOLLAR)->to(Field::create('profit_in_dollar', 'Profit In Dollar')->string());
            $table->mapProperty(SalesInvoice::TOTAL)->to(Field::create('total', 'Total')->string());
            $table->mapProperty(SalesInvoice::DISCOUNT_IN_PERCENT)->to(Field::create('discount_in_percent', 'Discount In Percent')->string());
            $table->mapProperty(SalesInvoice::DISCOUNT_IN_DOLLAR)->to(Field::create('discount_in_dollar', 'Discount In Dollar')->string());
            $table->mapProperty(SalesInvoice::TOTAL_AFTER_DISCOUNT)->to(Field::create('total_after_discount', 'Total After Discount')->string());
            $table->mapProperty(SalesInvoice::TOTAL_TAX)->to(Field::create('total_tax', 'Total Tax')->string());
            $table->mapProperty(SalesInvoice::FINAL_PRICE)->to(Field::create('final_price', 'Final Price')->string());
            $table->mapProperty(SalesInvoice::SALES_INVOICE_DETAIL)->to(Field::create('sales_invoice_detail', 'Sales Invoice Detail')
                ->entitiesFrom($this->salesInvoiceDetailRepository)
                ->labelledBy(/* FIXME: */ SalesInvoiceDetail::ID)
                ->mapToCollection(SalesInvoiceDetail::collectionType()));


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}