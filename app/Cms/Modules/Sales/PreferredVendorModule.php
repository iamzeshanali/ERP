<?php declare(strict_types = 1);

namespace App\Cms\Modules\Sales;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Sales\IPreferredVendorRepository;
use App\Domain\Entities\Sales\PreferredVendor;
use Dms\Common\Structure\Field;
use App\Domain\Services\Persistence\Financial\IPaymentTermsRepository;
use App\Domain\Entities\Financial\PaymentTerms;
use App\Domain\Entities\Enums\Status;

/**
 * The preferred-vendor module.
 */
class PreferredVendorModule extends CrudModule
{
    /**
     * @var IPaymentTermsRepository
     */
    protected $paymentTermsRepository;


    public function __construct(IPreferredVendorRepository $dataSource, IAuthSystem $authSystem, IPaymentTermsRepository $paymentTermsRepository)
    {
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
        $module->name('preferred-vendor');

        $module->labelObjects()->fromProperty(PreferredVendor::VENDOR_NUMBER);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('vendor_number', 'Vendor Number')->string()
                )->bindToProperty(PreferredVendor::VENDOR_NUMBER),
                //
                $form->field(
                    Field::create('name', 'Name')->string()
                )->bindToProperty(PreferredVendor::NAME),
                //
                $form->field(
                    Field::create('address_line1', 'Address Line1')->string()
                )->bindToProperty(PreferredVendor::ADDRESS_LINE_1),
                //
                $form->field(
                    Field::create('address_line2', 'Address Line2')->string()
                )->bindToProperty(PreferredVendor::ADDRESS_LINE_2),
                //
                $form->field(
                    Field::create('state', 'State')->string()
                )->bindToProperty(PreferredVendor::STATE),
                //
                $form->field(
                    Field::create('zip', 'Zip')->string()
                )->bindToProperty(PreferredVendor::ZIP),
                //
                $form->field(
                    Field::create('city', 'City')->string()
                )->bindToProperty(PreferredVendor::CITY),
                //
                $form->field(
                    Field::create('country', 'Country')->string()
                )->bindToProperty(PreferredVendor::COUNTRY),
                //
                $form->field(
                    Field::create('phone', 'Phone')->string()
                )->bindToProperty(PreferredVendor::PHONE),
                //
                $form->field(
                    Field::create('email', 'Email')->email()
                )->bindToProperty(PreferredVendor::EMAIL),
                //
                $form->field(
                    Field::create('website', 'Website')->url()
                )->bindToProperty(PreferredVendor::WEBSITE),
                //
                $form->field(
                    Field::create('payment_terms', 'Payment Terms')
                        ->entityFrom($this->paymentTermsRepository)
                        ->labelledBy(/* FIXME: */ PaymentTerms::ID)
                )->bindToProperty(PreferredVendor::PAYMENT_TERMS),
                //
                $form->field(
                    Field::create('license_number', 'License Number')->string()
                )->bindToProperty(PreferredVendor::LICENSE_NUMBER),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(Status::class, [
                        Status::ACTIVE => 'Active',
                        Status::INACTIVE => 'Inactive',
                    ])
                )->bindToProperty(PreferredVendor::STATUS),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(PreferredVendor::VENDOR_NUMBER)->to(Field::create('vendor_number', 'Vendor Number')->string());
            $table->mapProperty(PreferredVendor::NAME)->to(Field::create('name', 'Name')->string());
            $table->mapProperty(PreferredVendor::ADDRESS_LINE_1)->to(Field::create('address_line1', 'Address Line1')->string());
            $table->mapProperty(PreferredVendor::ADDRESS_LINE_2)->to(Field::create('address_line2', 'Address Line2')->string());
            $table->mapProperty(PreferredVendor::STATE)->to(Field::create('state', 'State')->string());
            $table->mapProperty(PreferredVendor::ZIP)->to(Field::create('zip', 'Zip')->string());
            $table->mapProperty(PreferredVendor::CITY)->to(Field::create('city', 'City')->string());
            $table->mapProperty(PreferredVendor::COUNTRY)->to(Field::create('country', 'Country')->string());
            $table->mapProperty(PreferredVendor::PHONE)->to(Field::create('phone', 'Phone')->string());
            $table->mapProperty(PreferredVendor::EMAIL)->to(Field::create('email', 'Email')->email());
            $table->mapProperty(PreferredVendor::WEBSITE)->to(Field::create('website', 'Website')->url());
            $table->mapProperty(PreferredVendor::PAYMENT_TERMS)->to(Field::create('payment_terms', 'Payment Terms')
                ->entityFrom($this->paymentTermsRepository)
                ->labelledBy(/* FIXME: */ PaymentTerms::ID));
            $table->mapProperty(PreferredVendor::LICENSE_NUMBER)->to(Field::create('license_number', 'License Number')->string());
            $table->mapProperty(PreferredVendor::STATUS)->to(Field::create('status', 'Status')->enum(Status::class, [
                Status::ACTIVE => 'Active',
                Status::INACTIVE => 'Inactive',
            ]));


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}