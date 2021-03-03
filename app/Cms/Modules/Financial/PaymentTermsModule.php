<?php declare(strict_types = 1);

namespace App\Cms\Modules\Financial;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Financial\IPaymentTermsRepository;
use App\Domain\Entities\Financial\PaymentTerms;
use Dms\Common\Structure\Field;
use App\Domain\Entities\Enums\Status;

/**
 * The payment-terms module.
 */
class PaymentTermsModule extends CrudModule
{


    public function __construct(IPaymentTermsRepository $dataSource, IAuthSystem $authSystem)
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
        $module->name('payment-terms');

        $module->labelObjects()->fromProperty(PaymentTerms::CODE);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->string()
                )->bindToProperty(PaymentTerms::CODE),
                //
                $form->field(
                    Field::create('term_description', 'Term Description')->html()
                )->bindToProperty(PaymentTerms::TERM_DESCRIPTION),
                //
                $form->field(
                    Field::create('status', 'Status')->enum(Status::class, [
                        Status::ACTIVE => 'Active',
                        Status::INACTIVE => 'Inactive',
                    ])
                )->bindToProperty(PaymentTerms::STATUS),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(PaymentTerms::CODE)->to(Field::create('code', 'Code')->string());
            $table->mapProperty(PaymentTerms::TERM_DESCRIPTION)->to(Field::create('term_description', 'Term Description')->html());
            $table->mapProperty(PaymentTerms::STATUS)->to(Field::create('status', 'Status')->enum(Status::class, [
                Status::ACTIVE => 'Active',
                Status::INACTIVE => 'Inactive',
            ]));


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}