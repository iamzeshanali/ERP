<?php declare(strict_types = 1);

namespace App\Cms\Modules\Sales\Customers;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Sales\Customers\ICustomersRepository;
use App\Domain\Entities\Sales\Customers\Customers;
use Dms\Common\Structure\Field;
use App\Domain\Entities\Enums\CustomerStatusEnum;
use App\Domain\Services\Persistence\Sales\Customers\ISalesRepresentativeRepository;
use App\Domain\Entities\Sales\Customers\SalesRepresentative;
use App\Domain\Services\Persistence\Sales\Customers\ICustomersGroupsRepository;
use App\Domain\Entities\Sales\Customers\CustomersGroups;

/**
 * The customers module.
 */
class CustomersModule extends CrudModule
{
    /**
     * @var ISalesRepresentativeRepository
     */
    protected $salesRepresentativeRepository;

    /**
     * @var ICustomersGroupsRepository
     */
    protected $customersGroupsRepository;


    public function __construct(ICustomersRepository $dataSource, IAuthSystem $authSystem, ISalesRepresentativeRepository $salesRepresentativeRepository, ICustomersGroupsRepository $customersGroupsRepository)
    {
        $this->salesRepresentativeRepository = $salesRepresentativeRepository;
        $this->customersGroupsRepository = $customersGroupsRepository;
        parent::__construct($dataSource, $authSystem);
    }

    /**
     * Defines the structure of this module.
     *
     * @param CrudModuleDefinition $module
     */
    protected function defineCrudModule(CrudModuleDefinition $module)
    {
        $module->name('customers');

        $module->labelObjects()->fromProperty(Customers::NUMBER);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('number', 'Number')->string()->required()
                )->bindToProperty(Customers::NUMBER),
                //
                $form->field(
                    Field::create('first_name', 'First Name')->string()->required()
                )->bindToProperty(Customers::FIRST_NAME),
                //
                $form->field(
                    Field::create('last_name', 'Last Name')->string()->required()
                )->bindToProperty(Customers::LAST_NAME),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(CustomerStatusEnum::class, [
                        CustomerStatusEnum::ACTIVE => 'Active',
                        CustomerStatusEnum::INACTIVE => 'Inactive',
                        CustomerStatusEnum::POTENTIAL => 'Potential',
                        CustomerStatusEnum::RESTRICTED => 'Restricted',
                        CustomerStatusEnum::WARNED => 'Warned',
                    ])->required()
                )->bindToProperty(Customers::STATUS),
                //
                $form->field(
                    Field::create('sales_representative', 'Sales Representative')
                        ->entityFrom($this->salesRepresentativeRepository)
                        ->labelledBy(SalesRepresentative::FIRST_NAME)
                )->bindToProperty(Customers::SALES_REPRESENTATIVE),
                //
                $form->field(
                    Field::create('tax', 'Tax')->string()->required()
                )->bindToProperty(Customers::TAX),
                //
                $form->field(
                    Field::create('address', 'Address')->string()->required()
                )->bindToProperty(Customers::ADDRESS),
                //
                $form->field(
                    Field::create('city', 'City')->string()->required()
                )->bindToProperty(Customers::CITY),
                //
                $form->field(
                    Field::create('state', 'State')->string()->required()
                )->bindToProperty(Customers::STATE),
                //
                $form->field(
                    Field::create('zip', 'Zip')->int()->required()
                )->bindToProperty(Customers::ZIP),
                //
                $form->field(
                    Field::create('country', 'Country')->string()
                )->bindToProperty(Customers::COUNTRY),
                //
                $form->field(
                    Field::create('phone', 'Phone')->string()
                )->bindToProperty(Customers::PHONE),
                //
                $form->field(
                    Field::create('fax', 'Fax')->string()
                )->bindToProperty(Customers::FAX),
                //
                $form->field(
                    Field::create('email', 'Email')->email()
                )->bindToProperty(Customers::EMAIL),
                //
                $form->field(
                    Field::create('group', 'Group')
                        ->entityFrom($this->customersGroupsRepository)
                        ->labelledBy(/* FIXME: */ CustomersGroups::ID)
                )->bindToProperty(Customers::GROUP),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(Customers::NUMBER)->to(Field::create('number', 'Number')->string()->required());
            $table->mapProperty(Customers::FIRST_NAME)->to(Field::create('first_name', 'First Name')->string()->required());
            $table->mapProperty(Customers::LAST_NAME)->to(Field::create('last_name', 'Last Name')->string()->required());
            $table->mapProperty(Customers::STATUS)->to(Field::create('status', 'Status')->enum(CustomerStatusEnum::class, [
                CustomerStatusEnum::ACTIVE => 'Active',
                CustomerStatusEnum::INACTIVE => 'Inactive',
                CustomerStatusEnum::POTENTIAL => 'Potential',
                CustomerStatusEnum::RESTRICTED => 'Restricted',
                CustomerStatusEnum::WARNED => 'Warned',
            ])->required());
            $table->mapProperty(Customers::SALES_REPRESENTATIVE)->to(Field::create('sales_representative', 'Sales Representative')
                ->entityFrom($this->salesRepresentativeRepository)
                ->labelledBy(SalesRepresentative::FIRST_NAME));
            $table->mapProperty(Customers::TAX)->to(Field::create('tax', 'Tax')->string()->required());
            $table->mapProperty(Customers::ADDRESS)->to(Field::create('address', 'Address')->string()->required());
            $table->mapProperty(Customers::CITY)->to(Field::create('city', 'City')->string()->required());
            $table->mapProperty(Customers::STATE)->to(Field::create('state', 'State')->string()->required());
            $table->mapProperty(Customers::ZIP)->to(Field::create('zip', 'Zip')->int()->required());
            $table->mapProperty(Customers::COUNTRY)->to(Field::create('country', 'Country')->string());
            $table->mapProperty(Customers::PHONE)->to(Field::create('phone', 'Phone')->string());
            $table->mapProperty(Customers::FAX)->to(Field::create('fax', 'Fax')->string());
            $table->mapProperty(Customers::EMAIL)->to(Field::create('email', 'Email')->email());
            $table->mapProperty(Customers::GROUP)->to(Field::create('group', 'Group')
                ->entityFrom($this->customersGroupsRepository)
                ->labelledBy(/* FIXME: */ CustomersGroups::ID));


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}