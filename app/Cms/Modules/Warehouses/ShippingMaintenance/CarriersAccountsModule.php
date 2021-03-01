<?php declare(strict_types = 1);

namespace App\Cms\Modules\Warehouses\ShippingMaintenance;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Warehouses\ShippingMaintenance\ICarriersAccountsRepository;
use App\Domain\Entities\Warehouses\ShippingMaintenance\CarriersAccounts;
use Dms\Common\Structure\Field;

/**
 * The carriers-accounts module.
 */
class CarriersAccountsModule extends CrudModule
{


    public function __construct(ICarriersAccountsRepository $dataSource, IAuthSystem $authSystem)
    {

        parent::__construct($dataSource, $authSystem);
    }

    /**
     * Defines the structure of this module.
     *
     * @param CrudModuleDefinition $module
     */
    protected function defineCrudModule(CrudModuleDefinition $module)
    {
        $module->name('carriers-accounts');

        $module->labelObjects()->fromProperty(CarriersAccounts::ACCOUNT_NO);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('account_no', 'Account No')->string()->required()
                )->bindToProperty(CarriersAccounts::ACCOUNT_NO),
                //
                $form->field(
                    Field::create('carrier_name', 'Carrier Name')->string()->required()
                )->bindToProperty(CarriersAccounts::CARRIER_NAME),
                //
                $form->field(
                    Field::create('contact_name', 'Contact Name')->string()->required()
                )->bindToProperty(CarriersAccounts::CONTACT_NAME),
                //
                $form->field(
                    Field::create('company_name', 'Company Name')->string()->required()
                )->bindToProperty(CarriersAccounts::COMPANY_NAME),
                //
                $form->field(
                    Field::create('address1', 'Address1')->string()->required()
                )->bindToProperty(CarriersAccounts::ADDRESS_1),
                //
                $form->field(
                    Field::create('address2', 'Address2')->string()
                )->bindToProperty(CarriersAccounts::ADDRESS_2),
                //
                $form->field(
                    Field::create('city', 'City')->string()->required()
                )->bindToProperty(CarriersAccounts::CITY),
                //
                $form->field(
                    Field::create('state', 'State')->string()->required()
                )->bindToProperty(CarriersAccounts::STATE),
                //
                $form->field(
                    Field::create('zip', 'Zip')->int()->required()
                )->bindToProperty(CarriersAccounts::ZIP),
                //
                $form->field(
                    Field::create('country', 'Country')->string()
                )->bindToProperty(CarriersAccounts::COUNTRY),
                //
                $form->field(
                    Field::create('in_active', 'In Active')->bool()
                )->bindToProperty(CarriersAccounts::INACTIVE),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(CarriersAccounts::ACCOUNT_NO)->to(Field::create('account_no', 'Account No')->string()->required());
            $table->mapProperty(CarriersAccounts::CARRIER_NAME)->to(Field::create('carrier_name', 'Carrier Name')->string()->required());
            $table->mapProperty(CarriersAccounts::CONTACT_NAME)->to(Field::create('contact_name', 'Contact Name')->string()->required());
            $table->mapProperty(CarriersAccounts::COMPANY_NAME)->to(Field::create('company_name', 'Company Name')->string()->required());
            $table->mapProperty(CarriersAccounts::ADDRESS_1)->to(Field::create('address1', 'Address1')->string()->required());
            $table->mapProperty(CarriersAccounts::ADDRESS_2)->to(Field::create('address2', 'Address2')->string());
            $table->mapProperty(CarriersAccounts::CITY)->to(Field::create('city', 'City')->string()->required());
            $table->mapProperty(CarriersAccounts::STATE)->to(Field::create('state', 'State')->string()->required());
            $table->mapProperty(CarriersAccounts::ZIP)->to(Field::create('zip', 'Zip')->int()->required());
            $table->mapProperty(CarriersAccounts::COUNTRY)->to(Field::create('country', 'Country')->string());
            $table->mapProperty(CarriersAccounts::INACTIVE)->to(Field::create('in_active', 'In Active')->bool());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}