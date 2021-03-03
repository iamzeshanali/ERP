<?php declare(strict_types = 1);

namespace App\Cms\Modules\Financial;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Financial\ISalesInvoiceDetailRepository;
use App\Domain\Entities\Financial\SalesInvoiceDetail;
use Dms\Common\Structure\Field;
use App\Domain\Services\Persistence\Sales\IProductRepository;
use App\Domain\Entities\Sales\Product;
use App\Domain\Services\Persistence\Sales\IBrandsRepository;
use App\Domain\Entities\Sales\Brands;
use App\Domain\Services\Persistence\Financial\ISalesInvoiceRepository;
use App\Domain\Entities\Financial\SalesInvoice;

/**
 * The sales-invoice-detail module.
 */
class SalesInvoiceDetailModule extends CrudModule
{
    /**
     * @var IProductRepository
     */
    protected $productRepository;

    /**
     * @var IBrandsRepository
     */
    protected $brandsRepository;

    /**
     * @var ISalesInvoiceRepository
     */
    protected $salesInvoiceRepository;


    public function __construct(ISalesInvoiceDetailRepository $dataSource, IAuthSystem $authSystem, IProductRepository $productRepository, IBrandsRepository $brandsRepository, ISalesInvoiceRepository $salesInvoiceRepository)
    {
        $this->productRepository = $productRepository;
        $this->brandsRepository = $brandsRepository;
        $this->salesInvoiceRepository = $salesInvoiceRepository;
        parent::__construct($dataSource, $authSystem);
    }

    /**
     * Defines the structure of this module.
     *
     * @param CrudModuleDefinition $module
     */
    protected function defineCrudModule(CrudModuleDefinition $module)
    {
        $module->name('sales-invoice-detail');

        $module->labelObjects()->fromProperty(SalesInvoiceDetail::QUANTITY);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('product', 'Product')
                        ->entityFrom($this->productRepository)
                        ->required()
                        ->labelledBy(/* FIXME: */ Product::ID)
                )->bindToProperty(SalesInvoiceDetail::PRODUCT),
                //
                $form->field(
                    Field::create('quantity', 'Quantity')->string()
                )->bindToProperty(SalesInvoiceDetail::QUANTITY),
                //
                $form->field(
                    Field::create('price', 'Price')->string()
                )->bindToProperty(SalesInvoiceDetail::PRICE),
                //
                $form->field(
                    Field::create('availability', 'Availability')->string()
                )->bindToProperty('availability'),
                //
                $form->field(
                    Field::create('due_date', 'Due Date')->date()->required()
                )->bindToProperty(SalesInvoiceDetail::DUE_DATE),
                //
                $form->field(
                    Field::create('discount', 'Discount')->string()
                )->bindToProperty(SalesInvoiceDetail::DISCOUNT),
                //
                $form->field(
                    Field::create('discount_type', 'Discount Type')->string()
                )->bindToProperty(SalesInvoiceDetail::DISCOUNT_TYPE),
                //
                $form->field(
                    Field::create('total', 'Total')->string()
                )->bindToProperty(SalesInvoiceDetail::TOTAL),
                //
                $form->field(
                    Field::create('brand', 'Brand')
                        ->entityFrom($this->brandsRepository)
                        ->labelledBy(/* FIXME: */ Brands::ID)
                )->bindToProperty(SalesInvoiceDetail::BRAND),
                //
                $form->field(
                    Field::create('sales_invoice', 'Sales Invoice')
                        ->entityFrom($this->salesInvoiceRepository)
                        ->required()
                        ->labelledBy(/* FIXME: */ SalesInvoice::ID)
                )->bindToProperty(SalesInvoiceDetail::SALES_INVOICE),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(SalesInvoiceDetail::PRODUCT)->to(Field::create('product', 'Product')
                ->entityFrom($this->productRepository)
                ->required()
                ->labelledBy(/* FIXME: */ Product::ID));
            $table->mapProperty(SalesInvoiceDetail::QUANTITY)->to(Field::create('quantity', 'Quantity')->string());
            $table->mapProperty(SalesInvoiceDetail::PRICE)->to(Field::create('price', 'Price')->string());
            $table->mapProperty('availability')->to(Field::create('availability', 'Availability')->string());
            $table->mapProperty(SalesInvoiceDetail::DUE_DATE)->to(Field::create('due_date', 'Due Date')->date()->required());
            $table->mapProperty(SalesInvoiceDetail::DISCOUNT)->to(Field::create('discount', 'Discount')->string());
            $table->mapProperty(SalesInvoiceDetail::DISCOUNT_TYPE)->to(Field::create('discount_type', 'Discount Type')->string());
            $table->mapProperty(SalesInvoiceDetail::TOTAL)->to(Field::create('total', 'Total')->string());
            $table->mapProperty(SalesInvoiceDetail::BRAND)->to(Field::create('brand', 'Brand')
                ->entityFrom($this->brandsRepository)
                ->labelledBy(/* FIXME: */ Brands::ID));
            $table->mapProperty(SalesInvoiceDetail::SALES_INVOICE)->to(Field::create('sales_invoice', 'Sales Invoice')
                ->entityFrom($this->salesInvoiceRepository)
                ->required()
                ->labelledBy(/* FIXME: */ SalesInvoice::ID));


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}