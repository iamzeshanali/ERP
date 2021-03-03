<?php declare(strict_types = 1);

namespace App\Cms\Modules\Sales;

use Dms\Core\Auth\IAuthSystem;
use Dms\Core\Common\Crud\CrudModule;
use Dms\Core\Common\Crud\Definition\CrudModuleDefinition;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Common\Crud\Definition\Table\SummaryTableDefinition;
use App\Domain\Services\Persistence\Sales\IProductRepository;
use App\Domain\Entities\Sales\Product;
use Dms\Common\Structure\Field;
use App\Domain\Entities\Enums\ProductStatus;
use App\Domain\Entities\Enums\ProductType;
use App\Domain\Services\Persistence\Inventory\IFamilyRepository;
use App\Domain\Entities\Inventory\Family;
use App\Domain\Services\Persistence\Sales\IBrandsRepository;
use App\Domain\Entities\Sales\Brands;
use App\Domain\Services\Persistence\Financial\ITaxClassRepository;
use App\Domain\Entities\Financial\TaxClass;
use App\Domain\Services\Persistence\Sales\IPreferredVendorRepository;
use App\Domain\Entities\Sales\PreferredVendor;
use App\Domain\Services\Persistence\Inventory\IUomRepository;
use App\Domain\Entities\Inventory\Uom;
use App\Domain\Services\Persistence\Inventory\IGroupRepository;
use App\Domain\Entities\Inventory\Group;
use App\Domain\Services\Persistence\Inventory\ICasePackRepository;
use App\Domain\Entities\Inventory\CasePack;

/**
 * The product module.
 */
class ProductModule extends CrudModule
{
    /**
     * @var IFamilyRepository
     */
    protected $familyRepository;

    /**
     * @var IBrandsRepository
     */
    protected $brandsRepository;

    /**
     * @var ITaxClassRepository
     */
    protected $taxClassRepository;

    /**
     * @var IPreferredVendorRepository
     */
    protected $preferredVendorRepository;

    /**
     * @var IUomRepository
     */
    protected $uomRepository;

    /**
     * @var IGroupRepository
     */
    protected $groupRepository;

    /**
     * @var ICasePackRepository
     */
    protected $casePackRepository;


    public function __construct(IProductRepository $dataSource, IAuthSystem $authSystem, IFamilyRepository $familyRepository, IBrandsRepository $brandsRepository, ITaxClassRepository $taxClassRepository, IPreferredVendorRepository $preferredVendorRepository, IUomRepository $uomRepository, IGroupRepository $groupRepository, ICasePackRepository $casePackRepository)
    {
        $this->familyRepository = $familyRepository;
        $this->brandsRepository = $brandsRepository;
        $this->taxClassRepository = $taxClassRepository;
        $this->preferredVendorRepository = $preferredVendorRepository;
        $this->uomRepository = $uomRepository;
        $this->groupRepository = $groupRepository;
        $this->casePackRepository = $casePackRepository;
        parent::__construct($dataSource, $authSystem);
    }

    /**
     * Defines the structure of this module.
     *
     * @param CrudModuleDefinition $module
     */
    protected function defineCrudModule(CrudModuleDefinition $module)
    {
        $module->name('product');

        $module->labelObjects()->fromProperty(Product::CODE);

        $module->metadata([
            'icon' => ''
        ]);

        $module->crudForm(function (CrudFormDefinition $form) {
            $form->section('Details', [
                $form->field(
                    Field::create('code', 'Code')->string()
                )->bindToProperty(Product::CODE),
                //
                $form->field(
                    Field::create('description', 'Description')->string()
                )->bindToProperty(Product::DESCRIPTION),
                //
                $form->field(
                    Field::create('product_status', 'Product Status')->enum(ProductStatus::class, [
                        ProductStatus::IN_USE => 'In Use',
                        ProductStatus::NOT_IN_USE => 'Not In Use',
                        ProductStatus::INACTIVE => 'Inactive',
                    ])
                )->bindToProperty(Product::PRODUCT_STATUS),
                //
                $form->field(
                    Field::create('product_type', 'Product Type')->enum(ProductType::class, [
                        ProductType::PRODUCT => 'Product',
                        ProductType::SERVICE => 'Service',
                    ])
                )->bindToProperty(Product::PRODUCT_TYPE),
                //
                $form->field(
                    Field::create('family', 'Family')
                        ->entityFrom($this->familyRepository)
                        ->labelledBy(/* FIXME: */ Family::ID)
                )->bindToProperty(Product::FAMILY),
                //
                $form->field(
                    Field::create('brand', 'Brand')
                        ->entityFrom($this->brandsRepository)
                        ->labelledBy(/* FIXME: */ Brands::ID)
                )->bindToProperty(Product::BRAND),
                //
                $form->field(
                    Field::create('tax_classification', 'Tax Classification')
                        ->entityFrom($this->taxClassRepository)
                        ->labelledBy(/* FIXME: */ TaxClass::ID)
                )->bindToProperty(Product::TAX_CLASSIFICATION),
                //
                $form->field(
                    Field::create('preferred_vendor', 'Preferred Vendor')
                        ->entityFrom($this->preferredVendorRepository)
                        ->labelledBy(PreferredVendor::NAME)
                )->bindToProperty(Product::PREFERRED_VENDOR),
                //
                $form->field(
                    Field::create('uom', 'Uom')
                        ->entityFrom($this->uomRepository)
                        ->labelledBy(/* FIXME: */ Uom::ID)
                )->bindToProperty(Product::UOM),
                //
                $form->field(
                    Field::create('group', 'Group')
                        ->entityFrom($this->groupRepository)
                        ->labelledBy(/* FIXME: */ Group::ID)
                )->bindToProperty(Product::GROUP),
                //
                $form->field(
                    Field::create('case_pack', 'Case Pack')
                        ->entityFrom($this->casePackRepository)
                        ->labelledBy(/* FIXME: */ CasePack::ID)
                )->bindToProperty(Product::CASE_PACK),
                //
                $form->field(
                    Field::create('sale_price', 'Sale Price')->string()
                )->bindToProperty(Product::SALE_PRICE),
                //
                $form->field(
                    Field::create('min_sale_price', 'Min Sale Price')->string()
                )->bindToProperty(Product::MIN_SALE_PRICE),
                //
                $form->field(
                    Field::create('purchased_price', 'Purchased Price')->string()
                )->bindToProperty(Product::PURCHASED_PRICE),
                //
                $form->field(
                    Field::create('margin', 'Margin')->string()
                )->bindToProperty(Product::margin),
                //
                $form->field(
                    Field::create('on_hand', 'On Hand')->string()
                )->bindToProperty(Product::ON_HAND),
                //
            ]);

        });

        $module->removeAction()->deleteFromDataSource();

        $module->summaryTable(function (SummaryTableDefinition $table) {
            $table->mapProperty(Product::CODE)->to(Field::create('code', 'Code')->string());
            $table->mapProperty(Product::DESCRIPTION)->to(Field::create('description', 'Description')->string());
            $table->mapProperty(Product::PRODUCT_STATUS)->to(Field::create('product_status', 'Product Status')->enum(ProductStatus::class, [
                ProductStatus::IN_USE => 'In Use',
                ProductStatus::NOT_IN_USE => 'Not In Use',
                ProductStatus::INACTIVE => 'Inactive',
            ]));
            $table->mapProperty(Product::PRODUCT_TYPE)->to(Field::create('product_type', 'Product Type')->enum(ProductType::class, [
                ProductType::PRODUCT => 'Product',
                ProductType::SERVICE => 'Service',
            ]));
            $table->mapProperty(Product::FAMILY)->to(Field::create('family', 'Family')
                ->entityFrom($this->familyRepository)
                ->labelledBy(/* FIXME: */ Family::ID));
            $table->mapProperty(Product::BRAND)->to(Field::create('brand', 'Brand')
                ->entityFrom($this->brandsRepository)
                ->labelledBy(/* FIXME: */ Brands::ID));
            $table->mapProperty(Product::TAX_CLASSIFICATION)->to(Field::create('tax_classification', 'Tax Classification')
                ->entityFrom($this->taxClassRepository)
                ->labelledBy(/* FIXME: */ TaxClass::ID));
            $table->mapProperty(Product::PREFERRED_VENDOR)->to(Field::create('preferred_vendor', 'Preferred Vendor')
                ->entityFrom($this->preferredVendorRepository)
                ->labelledBy(PreferredVendor::NAME));
            $table->mapProperty(Product::UOM)->to(Field::create('uom', 'Uom')
                ->entityFrom($this->uomRepository)
                ->labelledBy(/* FIXME: */ Uom::ID));
            $table->mapProperty(Product::GROUP)->to(Field::create('group', 'Group')
                ->entityFrom($this->groupRepository)
                ->labelledBy(/* FIXME: */ Group::ID));
            $table->mapProperty(Product::CASE_PACK)->to(Field::create('case_pack', 'Case Pack')
                ->entityFrom($this->casePackRepository)
                ->labelledBy(/* FIXME: */ CasePack::ID));
            $table->mapProperty(Product::SALE_PRICE)->to(Field::create('sale_price', 'Sale Price')->string());
            $table->mapProperty(Product::MIN_SALE_PRICE)->to(Field::create('min_sale_price', 'Min Sale Price')->string());
            $table->mapProperty(Product::PURCHASED_PRICE)->to(Field::create('purchased_price', 'Purchased Price')->string());
            $table->mapProperty(Product::margin)->to(Field::create('margin', 'Margin')->string());
            $table->mapProperty(Product::ON_HAND)->to(Field::create('on_hand', 'On Hand')->string());


            $table->view('all', 'All')
                ->loadAll()
                ->asDefault();
        });
    }
}