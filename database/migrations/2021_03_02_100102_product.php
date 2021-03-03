<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('family_id')->unsigned();
            $table->integer('brands_id')->unsigned();
            $table->integer('tax_class_id')->unsigned();
            $table->integer('preferred_vendor_id')->unsigned();
            $table->integer('uom_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->integer('case_pack_id')->unsigned();
            $table->string('code', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->enum('product_status', ['inUse', 'notInUse', 'inactive'])->comment('(DC2Type:CustomEnum__inUse__notInUse__inactive)')->nullable();
            $table->enum('product_type', ['product', 'service'])->comment('(DC2Type:CustomEnum__product__service)')->nullable();
            $table->string('sale_price', 255)->nullable();
            $table->string('min_sale_price', 255)->nullable();
            $table->string('purchased_price', 255)->nullable();
            $table->string('margin', 255)->nullable();
            $table->string('on_hand', 255)->nullable();

            $table->index('family_id', 'IDX_B3BA5A5AC35E566A');
            $table->index('brands_id', 'IDX_B3BA5A5AE9EEC0C7');
            $table->index('tax_class_id', 'IDX_B3BA5A5AA94AAAE');
            $table->index('preferred_vendor_id', 'IDX_B3BA5A5A2B185486');
            $table->index('uom_id', 'IDX_B3BA5A5AA103EEB1');
            $table->index('group_id', 'IDX_B3BA5A5AFE54D947');
            $table->index('case_pack_id', 'IDX_B3BA5A5AB6BA471C');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('family_id', 'fk_products_family_id_families')
                    ->references('id')
                    ->on('families')
                    ->onUpdate('cascade');
            $table->foreign('brands_id', 'fk_products_brands_id_brands')
                    ->references('id')
                    ->on('brands')
                    ->onUpdate('cascade');
            $table->foreign('tax_class_id', 'fk_products_tax_class_id_tax_classes')
                    ->references('id')
                    ->on('tax_classes')
                    ->onUpdate('cascade');
            $table->foreign('preferred_vendor_id', 'fk_products_preferred_vendor_id_preferred_vendors')
                    ->references('id')
                    ->on('preferred_vendors')
                    ->onUpdate('cascade');
            $table->foreign('uom_id', 'fk_products_uom_id_uoms')
                    ->references('id')
                    ->on('uoms')
                    ->onUpdate('cascade');
            $table->foreign('group_id', 'fk_products_group_id_groups')
                    ->references('id')
                    ->on('groups')
                    ->onUpdate('cascade');
            $table->foreign('case_pack_id', 'fk_products_case_pack_id_case_packs')
                    ->references('id')
                    ->on('case_packs')
                    ->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');

    }
}
