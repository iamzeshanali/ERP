<?php declare(strict_types = 1);

namespace App\Cms\Modules\Sales\Customers;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Sales\Customers\ICustomersGroupsRepository;
use App\Domain\Entities\Sales\Customers\CustomersGroups;
use Dms\Common\Structure\Field;

/**
 * The customers-groups module.
 */
class CustomersGroupsModule extends CrudModule
{


    public function __construct(ICustomersGroupsRepository $dataSource, IAuthSystem $authSystem)
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
        $module->name('customers-groups');

        $module->labelObjects()->fromProperty(/* FIXME: */ CustomersGroups::ID);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->int()->required()
                )->bindToProperty(CustomersGroups::CODE),
                //
                $form->field(
                    Field::create('description', 'Description')->html()->required()
                )->bindToProperty(CustomersGroups::DESCRIPTION),
                //
                $form->field(
                    Field::create('in_active', 'In Active')->bool()
                )->bindToProperty(CustomersGroups::INACTIVE),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(CustomersGroups::CODE)->to(Field::create('code', 'Code')->int()->required());
            $table->mapProperty(CustomersGroups::DESCRIPTION)->to(Field::create('description', 'Description')->html()->required());
            $table->mapProperty(CustomersGroups::INACTIVE)->to(Field::create('in_active', 'In Active')->bool());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}