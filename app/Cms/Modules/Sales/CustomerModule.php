<?php declare(strict_types = 1);

namespace App\Cms\Modules\Sales;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Sales\ICustomerRepository;
use App\Domain\Entities\Sales\Customer;
use Dms\Common\Structure\Field;
use App\Domain\Entities\Enums\CustomerStatus;
use App\Domain\Services\Persistence\Sales\ISalesRepresentativeRepository;
use App\Domain\Entities\Sales\SalesRepresentative;
use App\Domain\Services\Persistence\Financial\IPaymentTermsRepository;
use App\Domain\Entities\Financial\PaymentTerms;

/**
 * The customer module.
 */
class CustomerModule extends CrudModule
{
    /**
     * @var ISalesRepresentativeRepository
     */
    protected $salesRepresentativeRepository;

    /**
     * @var IPaymentTermsRepository
     */
    protected $paymentTermsRepository;


    public function __construct(ICustomerRepository $dataSource, IAuthSystem $authSystem, ISalesRepresentativeRepository $salesRepresentativeRepository, IPaymentTermsRepository $paymentTermsRepository)
    {
        $this->salesRepresentativeRepository = $salesRepresentativeRepository;
        $this->paymentTermsRepository = $paymentTermsRepository;
        parent::__construct($dataSource, $authSystem);
    }

    /**
     * Defines the structure of this module.
     *
     * @param CrudModuleDefinition $module
     */
    protected function defineCrudModule(CrudModuleDefinition $module)
    {
        $module->name('customer');

        $module->labelObjects()->fromProperty(Customer::CUSTOMER_NAME);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('customer_name', 'Customer Name')->string()
                )->bindToProperty(Customer::CUSTOMER_NAME),
                //
                $form->field(
                    Field::create('customer_number', 'Customer Number')->string()
                )->bindToProperty(Customer::CUSTOMER_NUMBER),
                //
                $form->field(
                    Field::create('email', 'Email')->email()
                )->bindToProperty('email'),
                //
                $form->field(
                    Field::create('customer_status', 'Customer Status')->enum(CustomerStatus::class, [
                        CustomerStatus::POTENTIAL => 'Potential',
                        CustomerStatus::ACTIVE => 'Active',
                        CustomerStatus::RESTRICTED => 'Restricted',
                        CustomerStatus::INACTIVE => 'Inactive',
                    ])
                )->bindToProperty(Customer::CUSTOMER_STATUS),
                //
                $form->field(
                    Field::create('sales_representative', 'Sales Representative')
                        ->entityFrom($this->salesRepresentativeRepository)
                        ->required()
                        ->labelledBy(SalesRepresentative::NAME)
                )->bindToProperty(Customer::SALES_REPRESENTATIVE),
                //
                $form->field(
                    Field::create('address_line1', 'Address Line1')->string()
                )->bindToProperty(Customer::ADDRESS_LINE_1),
                //
                $form->field(
                    Field::create('address_line2', 'Address Line2')->string()
                )->bindToProperty(Customer::ADDRESS_LINE_2),
                //
                $form->field(
                    Field::create('state', 'State')->string()
                )->bindToProperty(Customer::STATE),
                //
                $form->field(
                    Field::create('zip', 'Zip')->string()
                )->bindToProperty(Customer::ZIP),
                //
                $form->field(
                    Field::create('city', 'City')->string()
                )->bindToProperty(Customer::CITY),
                //
                $form->field(
                    Field::create('country', 'Country')->string()
                )->bindToProperty(Customer::COUNTRY),
                //
                $form->field(
                    Field::create('is_shipping_same', 'Is Shipping Same')->bool()
                )->bindToProperty(Customer::IS_SHIPPING_SAME),
                //
                $form->field(
                    Field::create('shipping_address_line1', 'Shipping Address Line1')->string()
                )->bindToProperty(Customer::SHIPPING_ADDRESS_LINE_1),
                //
                $form->field(
                    Field::create('shipping_address_line2', 'Shipping Address Line2')->string()
                )->bindToProperty(Customer::SHIPPING_ADDRESS_LINE_2),
                //
                $form->field(
                    Field::create('shipping_state', 'Shipping State')->string()
                )->bindToProperty(Customer::SHIPPING_STATE),
                //
                $form->field(
                    Field::create('shipping_zip', 'Shipping Zip')->string()
                )->bindToProperty(Customer::SHIPPING_ZIP),
                //
                $form->field(
                    Field::create('shipping_city', 'Shipping City')->string()
                )->bindToProperty(Customer::SHIPPING_CITY),
                //
                $form->field(
                    Field::create('shipping_country', 'Shipping Country')->string()
                )->bindToProperty(Customer::SHIPPING_COUNTRY),
                //
                $form->field(
                    Field::create('phone', 'Phone')->string()
                )->bindToProperty(Customer::PHONE),
                //
                $form->field(
                    Field::create('bev_licence_number', 'Bev Licence Number')->string()
                )->bindToProperty('bevLicenceNumber'),
                //
                $form->field(
                    Field::create('payment_terms', 'Payment Terms')
                        ->entityFrom($this->paymentTermsRepository)
                        ->labelledBy(/* FIXME: */ PaymentTerms::ID)
                )->bindToProperty(Customer::PAYMENT_TERMS),
                //
                $form->field(
                    Field::create('number_of_pallets', 'Number Of Pallets')->string()
                )->bindToProperty(Customer::NUMBER_OF_PALLETS),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(Customer::CUSTOMER_NAME)->to(Field::create('customer_name', 'Customer Name')->string());
            $table->mapProperty(Customer::CUSTOMER_NUMBER)->to(Field::create('customer_number', 'Customer Number')->string());
            $table->mapProperty('email')->to(Field::create('email', 'Email')->email());
            $table->mapProperty(Customer::CUSTOMER_STATUS)->to(Field::create('customer_status', 'Customer Status')->enum(CustomerStatus::class, [
                CustomerStatus::POTENTIAL => 'Potential',
                CustomerStatus::ACTIVE => 'Active',
                CustomerStatus::RESTRICTED => 'Restricted',
                CustomerStatus::INACTIVE => 'Inactive',
            ]));
            $table->mapProperty(Customer::SALES_REPRESENTATIVE)->to(Field::create('sales_representative', 'Sales Representative')
                ->entityFrom($this->salesRepresentativeRepository)
                ->required()
                ->labelledBy(SalesRepresentative::NAME));
            $table->mapProperty(Customer::ADDRESS_LINE_1)->to(Field::create('address_line1', 'Address Line1')->string());
            $table->mapProperty(Customer::ADDRESS_LINE_2)->to(Field::create('address_line2', 'Address Line2')->string());
            $table->mapProperty(Customer::STATE)->to(Field::create('state', 'State')->string());
            $table->mapProperty(Customer::ZIP)->to(Field::create('zip', 'Zip')->string());
            $table->mapProperty(Customer::CITY)->to(Field::create('city', 'City')->string());
            $table->mapProperty(Customer::COUNTRY)->to(Field::create('country', 'Country')->string());
            $table->mapProperty(Customer::IS_SHIPPING_SAME)->to(Field::create('is_shipping_same', 'Is Shipping Same')->bool());
            $table->mapProperty(Customer::SHIPPING_ADDRESS_LINE_1)->to(Field::create('shipping_address_line1', 'Shipping Address Line1')->string());
            $table->mapProperty(Customer::SHIPPING_ADDRESS_LINE_2)->to(Field::create('shipping_address_line2', 'Shipping Address Line2')->string());
            $table->mapProperty(Customer::SHIPPING_STATE)->to(Field::create('shipping_state', 'Shipping State')->string());
            $table->mapProperty(Customer::SHIPPING_ZIP)->to(Field::create('shipping_zip', 'Shipping Zip')->string());
            $table->mapProperty(Customer::SHIPPING_CITY)->to(Field::create('shipping_city', 'Shipping City')->string());
            $table->mapProperty(Customer::SHIPPING_COUNTRY)->to(Field::create('shipping_country', 'Shipping Country')->string());
            $table->mapProperty(Customer::PHONE)->to(Field::create('phone', 'Phone')->string());
            $table->mapProperty('bevLicenceNumber')->to(Field::create('bev_licence_number', 'Bev Licence Number')->string());
            $table->mapProperty(Customer::PAYMENT_TERMS)->to(Field::create('payment_terms', 'Payment Terms')
                ->entityFrom($this->paymentTermsRepository)
                ->labelledBy(/* FIXME: */ PaymentTerms::ID));
            $table->mapProperty(Customer::NUMBER_OF_PALLETS)->to(Field::create('number_of_pallets', 'Number Of Pallets')->string());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}