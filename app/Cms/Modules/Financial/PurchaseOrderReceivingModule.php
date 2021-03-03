<?php declare(strict_types = 1);

namespace App\Cms\Modules\Financial;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Financial\IPurchaseOrderReceivingRepository;
use App\Domain\Entities\Financial\PurchaseOrderReceiving;
use Dms\Common\Structure\Field;
use App\Domain\Services\Persistence\Sales\IProductRepository;
use App\Domain\Entities\Sales\Product;
use App\Domain\Services\Persistence\Sales\IBrandsRepository;
use App\Domain\Entities\Sales\Brands;
use App\Domain\Services\Persistence\Financial\IPurchaseOrderRepository;
use App\Domain\Entities\Financial\PurchaseOrder;

/**
 * The purchase-order-receiving module.
 */
class PurchaseOrderReceivingModule extends CrudModule
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
     * @var IPurchaseOrderRepository
     */
    protected $purchaseOrderRepository;


    public function __construct(IPurchaseOrderReceivingRepository $dataSource, IAuthSystem $authSystem, IProductRepository $productRepository, IBrandsRepository $brandsRepository, IPurchaseOrderRepository $purchaseOrderRepository)
    {
        $this->productRepository = $productRepository;
        $this->brandsRepository = $brandsRepository;
        $this->purchaseOrderRepository = $purchaseOrderRepository;
        parent::__construct($dataSource, $authSystem);
    }

    /**
     * Defines the structure of this module.
     *
     * @param CrudModuleDefinition $module
     */
    protected function defineCrudModule(CrudModuleDefinition $module)
    {
        $module->name('purchase-order-receiving');

        $module->labelObjects()->fromProperty(PurchaseOrderReceiving::QUANTITY);

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
                )->bindToProperty(PurchaseOrderReceiving::PRODUCT),
                //
                $form->field(
                    Field::create('quantity', 'Quantity')->string()
                )->bindToProperty(PurchaseOrderReceiving::QUANTITY),
                //
                $form->field(
                    Field::create('due_date', 'Due Date')->date()->required()
                )->bindToProperty(PurchaseOrderReceiving::DUE_DATE),
                //
                $form->field(
                    Field::create('discount', 'Discount')->string()
                )->bindToProperty(PurchaseOrderReceiving::DISCOUNT),
                //
                $form->field(
                    Field::create('discount_type', 'Discount Type')->string()
                )->bindToProperty(PurchaseOrderReceiving::DISCOUNT_TYPE),
                //
                $form->field(
                    Field::create('total', 'Total')->string()
                )->bindToProperty(PurchaseOrderReceiving::TOTAL),
                //
                $form->field(
                    Field::create('brand', 'Brand')
                        ->entityFrom($this->brandsRepository)
                        ->labelledBy(/* FIXME: */ Brands::ID)
                )->bindToProperty(PurchaseOrderReceiving::BRAND),
                //
                $form->field(
                    Field::create('purchase_order', 'Purchase Order')
                        ->entityFrom($this->purchaseOrderRepository)
                        ->required()
                        ->labelledBy(/* FIXME: */ PurchaseOrder::ID)
                )->bindToProperty(PurchaseOrderReceiving::PURCHASE_ORDER),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(PurchaseOrderReceiving::PRODUCT)->to(Field::create('product', 'Product')
                ->entityFrom($this->productRepository)
                ->required()
                ->labelledBy(/* FIXME: */ Product::ID));
            $table->mapProperty(PurchaseOrderReceiving::QUANTITY)->to(Field::create('quantity', 'Quantity')->string());
            $table->mapProperty(PurchaseOrderReceiving::DUE_DATE)->to(Field::create('due_date', 'Due Date')->date()->required());
            $table->mapProperty(PurchaseOrderReceiving::DISCOUNT)->to(Field::create('discount', 'Discount')->string());
            $table->mapProperty(PurchaseOrderReceiving::DISCOUNT_TYPE)->to(Field::create('discount_type', 'Discount Type')->string());
            $table->mapProperty(PurchaseOrderReceiving::TOTAL)->to(Field::create('total', 'Total')->string());
            $table->mapProperty(PurchaseOrderReceiving::BRAND)->to(Field::create('brand', 'Brand')
                ->entityFrom($this->brandsRepository)
                ->labelledBy(/* FIXME: */ Brands::ID));
            $table->mapProperty(PurchaseOrderReceiving::PURCHASE_ORDER)->to(Field::create('purchase_order', 'Purchase Order')
                ->entityFrom($this->purchaseOrderRepository)
                ->required()
                ->labelledBy(/* FIXME: */ PurchaseOrder::ID));


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}