<?php declare(strict_types = 1);

namespace App\Cms\Modules\Financial;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Financial\IPurchaseOrderRepository;
use App\Domain\Entities\Financial\PurchaseOrder;
use Dms\Common\Structure\Field;
use App\Domain\Services\Persistence\Sales\IPreferredVendorRepository;
use App\Domain\Entities\Sales\PreferredVendor;
use App\Domain\Entities\Enums\PurchaseOrderStatus;
use App\Domain\Services\Persistence\Financial\IPaymentTermsRepository;
use App\Domain\Entities\Financial\PaymentTerms;
use App\Domain\Services\Persistence\Warehouse\IShipmentsRepository;
use App\Domain\Entities\Warehouse\Shipments;
use App\Domain\Services\Persistence\Financial\IPurchaseOrderDetailRepository;
use App\Domain\Entities\Financial\PurchaseOrderDetail;
use App\Domain\Services\Persistence\Financial\IPurchaseOrderReceivingRepository;
use App\Domain\Entities\Financial\PurchaseOrderReceiving;

/**
 * The purchase-order module.
 */
class PurchaseOrderModule extends CrudModule
{
    /**
     * @var IPreferredVendorRepository
     */
    protected $preferredVendorRepository;

    /**
     * @var IPaymentTermsRepository
     */
    protected $paymentTermsRepository;

    /**
     * @var IShipmentsRepository
     */
    protected $shipmentsRepository;

    /**
     * @var IPurchaseOrderDetailRepository
     */
    protected $purchaseOrderDetailRepository;

    /**
     * @var IPurchaseOrderReceivingRepository
     */
    protected $purchaseOrderReceivingRepository;


    public function __construct(IPurchaseOrderRepository $dataSource, IAuthSystem $authSystem, IPreferredVendorRepository $preferredVendorRepository, IPaymentTermsRepository $paymentTermsRepository, IShipmentsRepository $shipmentsRepository, IPurchaseOrderDetailRepository $purchaseOrderDetailRepository, IPurchaseOrderReceivingRepository $purchaseOrderReceivingRepository)
    {
        $this->preferredVendorRepository = $preferredVendorRepository;
        $this->paymentTermsRepository = $paymentTermsRepository;
        $this->shipmentsRepository = $shipmentsRepository;
        $this->purchaseOrderDetailRepository = $purchaseOrderDetailRepository;
        $this->purchaseOrderReceivingRepository = $purchaseOrderReceivingRepository;
        parent::__construct($dataSource, $authSystem);
    }

    /**
     * Defines the structure of this module.
     *
     * @param CrudModuleDefinition $module
     */
    protected function defineCrudModule(CrudModuleDefinition $module)
    {
        $module->name('purchase-order');

        $module->labelObjects()->fromProperty(PurchaseOrder::DOCUMENT_NUMBER);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('vendor', 'Vendor')
                        ->entityFrom($this->preferredVendorRepository)
                        ->labelledBy(PreferredVendor::NAME)
                )->bindToProperty(PurchaseOrder::VENDOR),
                //
                $form->field(
                    Field::create('date', 'Date')->date()
                )->bindToProperty(PurchaseOrder::DATE),
                //
                $form->field(
                    Field::create('document_number', 'Document Number')->string()
                )->bindToProperty(PurchaseOrder::DOCUMENT_NUMBER),
                //
                $form->field(
                    Field::create('invoice_number', 'Invoice Number')->string()
                )->bindToProperty(PurchaseOrder::INVOICE_NUMBER),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(PurchaseOrderStatus::class, [
                        PurchaseOrderStatus::DRAFT => 'Draft',
                        PurchaseOrderStatus::IN_PROGRESS => 'In Progress',
                        PurchaseOrderStatus::ALLOW_RECEIVE => 'Allow Receive',
                        PurchaseOrderStatus::CANCEL => 'Cancel',
                    ])
                )->bindToProperty(PurchaseOrder::STATUS),
                //
                $form->field(
                    Field::create('payment_term', 'Payment Term')
                        ->entityFrom($this->paymentTermsRepository)
                        ->labelledBy(/* FIXME: */ PaymentTerms::ID)
                )->bindToProperty(PurchaseOrder::PAYMENT_TERM),
                //
                $form->field(
                    Field::create('total', 'Total')->string()
                )->bindToProperty(PurchaseOrder::TOTAL),
                //
                $form->field(
                    Field::create('discount', 'Discount')->string()
                )->bindToProperty(PurchaseOrder::DISCOUNT),
                //
                $form->field(
                    Field::create('discount_type', 'Discount Type')->string()
                )->bindToProperty(PurchaseOrder::DISCOUNT_TYPE),
                //
                $form->field(
                    Field::create('total_after_discount', 'Total After Discount')->string()
                )->bindToProperty(PurchaseOrder::TOTAL_AFTER_DISCOUNT),
                //
                $form->field(
                    Field::create('final_price', 'Final Price')->string()
                )->bindToProperty(PurchaseOrder::FINAL_PRICE),
                //
                $form->field(
                    Field::create('shipping_address_line1', 'Shipping Address Line1')->string()
                )->bindToProperty(PurchaseOrder::SHIPPING_ADDRESS_LINE_1),
                //
                $form->field(
                    Field::create('shipping_address_line2', 'Shipping Address Line2')->string()
                )->bindToProperty(PurchaseOrder::SHIPPING_ADDRESS_LINE_2),
                //
                $form->field(
                    Field::create('shipping_state', 'Shipping State')->string()
                )->bindToProperty(PurchaseOrder::SHIPPING_STATE),
                //
                $form->field(
                    Field::create('shipping_zip', 'Shipping Zip')->string()
                )->bindToProperty(PurchaseOrder::SHIPPING_ZIP),
                //
                $form->field(
                    Field::create('shipping_city', 'Shipping City')->string()
                )->bindToProperty(PurchaseOrder::SHIPPING_CITY),
                //
                $form->field(
                    Field::create('shipping_country', 'Shipping Country')->string()
                )->bindToProperty(PurchaseOrder::SHIPPING_COUNTRY),
                //
                $form->field(
                    Field::create('shipping_code', 'Shipping Code')
                        ->entityFrom($this->shipmentsRepository)
                        ->required()
                        ->labelledBy(/* FIXME: */ Shipments::ID)
                )->bindToProperty(PurchaseOrder::SHIPPING_CODE),
                //
                $form->field(
                    Field::create('purchase_order_details', 'Purchase Order Details')
                        ->entitiesFrom($this->purchaseOrderDetailRepository)
                        ->labelledBy(/* FIXME: */ PurchaseOrderDetail::ID)
                        ->mapToCollection(PurchaseOrderDetail::collectionType())
                )->bindToProperty(PurchaseOrder::PURCHASE_ORDER_DETAILS),
                //
                $form->field(
                    Field::create('purchase_order_receiving', 'Purchase Order Receiving')
                        ->entitiesFrom($this->purchaseOrderReceivingRepository)
                        ->labelledBy(/* FIXME: */ PurchaseOrderReceiving::ID)
                        ->mapToCollection(PurchaseOrderReceiving::collectionType())
                )->bindToProperty(PurchaseOrder::PURCHASE_ORDER_RECEIVING),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(PurchaseOrder::VENDOR)->to(Field::create('vendor', 'Vendor')
                ->entityFrom($this->preferredVendorRepository)
                ->labelledBy(PreferredVendor::NAME));
            $table->mapProperty(PurchaseOrder::DATE)->to(Field::create('date', 'Date')->date());
            $table->mapProperty(PurchaseOrder::DOCUMENT_NUMBER)->to(Field::create('document_number', 'Document Number')->string());
            $table->mapProperty(PurchaseOrder::INVOICE_NUMBER)->to(Field::create('invoice_number', 'Invoice Number')->string());
            $table->mapProperty(PurchaseOrder::STATUS)->to(Field::create('status', 'Status')->enum(PurchaseOrderStatus::class, [
                PurchaseOrderStatus::DRAFT => 'Draft',
                PurchaseOrderStatus::IN_PROGRESS => 'In Progress',
                PurchaseOrderStatus::ALLOW_RECEIVE => 'Allow Receive',
                PurchaseOrderStatus::CANCEL => 'Cancel',
            ]));
            $table->mapProperty(PurchaseOrder::PAYMENT_TERM)->to(Field::create('payment_term', 'Payment Term')
                ->entityFrom($this->paymentTermsRepository)
                ->labelledBy(/* FIXME: */ PaymentTerms::ID));
            $table->mapProperty(PurchaseOrder::TOTAL)->to(Field::create('total', 'Total')->string());
            $table->mapProperty(PurchaseOrder::DISCOUNT)->to(Field::create('discount', 'Discount')->string());
            $table->mapProperty(PurchaseOrder::DISCOUNT_TYPE)->to(Field::create('discount_type', 'Discount Type')->string());
            $table->mapProperty(PurchaseOrder::TOTAL_AFTER_DISCOUNT)->to(Field::create('total_after_discount', 'Total After Discount')->string());
            $table->mapProperty(PurchaseOrder::FINAL_PRICE)->to(Field::create('final_price', 'Final Price')->string());
            $table->mapProperty(PurchaseOrder::SHIPPING_ADDRESS_LINE_1)->to(Field::create('shipping_address_line1', 'Shipping Address Line1')->string());
            $table->mapProperty(PurchaseOrder::SHIPPING_ADDRESS_LINE_2)->to(Field::create('shipping_address_line2', 'Shipping Address Line2')->string());
            $table->mapProperty(PurchaseOrder::SHIPPING_STATE)->to(Field::create('shipping_state', 'Shipping State')->string());
            $table->mapProperty(PurchaseOrder::SHIPPING_ZIP)->to(Field::create('shipping_zip', 'Shipping Zip')->string());
            $table->mapProperty(PurchaseOrder::SHIPPING_CITY)->to(Field::create('shipping_city', 'Shipping City')->string());
            $table->mapProperty(PurchaseOrder::SHIPPING_COUNTRY)->to(Field::create('shipping_country', 'Shipping Country')->string());
            $table->mapProperty(PurchaseOrder::SHIPPING_CODE)->to(Field::create('shipping_code', 'Shipping Code')
                ->entityFrom($this->shipmentsRepository)
                ->required()
                ->labelledBy(/* FIXME: */ Shipments::ID));
            $table->mapProperty(PurchaseOrder::PURCHASE_ORDER_DETAILS)->to(Field::create('purchase_order_details', 'Purchase Order Details')
                ->entitiesFrom($this->purchaseOrderDetailRepository)
                ->labelledBy(/* FIXME: */ PurchaseOrderDetail::ID)
                ->mapToCollection(PurchaseOrderDetail::collectionType()));
            $table->mapProperty(PurchaseOrder::PURCHASE_ORDER_RECEIVING)->to(Field::create('purchase_order_receiving', 'Purchase Order Receiving')
                ->entitiesFrom($this->purchaseOrderReceivingRepository)
                ->labelledBy(/* FIXME: */ PurchaseOrderReceiving::ID)
                ->mapToCollection(PurchaseOrderReceiving::collectionType()));


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}