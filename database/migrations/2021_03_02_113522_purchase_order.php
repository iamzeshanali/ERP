<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PurchaseOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('preferred_vendor_id')->unsigned();
            $table->integer('payment_term_id')->unsigned();
            $table->integer('shipping_code_id')->unsigned();
            $table->date('date')->nullable();
            $table->string('document_number', 255)->nullable();
            $table->string('invoice_number', 255)->nullable();
            $table->enum('status', ['draft', 'inProgress', 'allowReceive', 'cancel'])->comment('(DC2Type:CustomEnum__draft__inProgress__allowReceive__cancel)')->nullable();
            $table->string('total', 255)->nullable();
            $table->string('discount', 255)->nullable();
            $table->string('discount_type', 255)->nullable();
            $table->string('total_after_discount', 255)->nullable();
            $table->string('final_price', 255)->nullable();
            $table->string('shipping_address_line1', 255)->nullable();
            $table->string('shipping_address_line2', 255)->nullable();
            $table->string('shipping_state', 255)->nullable();
            $table->string('shipping_zip', 255)->nullable();
            $table->string('shipping_city', 255)->nullable();
            $table->string('shipping_country', 255)->nullable();

            $table->index('preferred_vendor_id', 'IDX_3E40FFBB2B185486');
            $table->index('payment_term_id', 'IDX_3E40FFBB17653B16');
            $table->index('shipping_code_id', 'IDX_3E40FFBBC192F8D3');
        });

        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('purchase_order_detail_id')->unsigned();
            $table->string('quantity', 255)->nullable();
            $table->string('unit_price', 255)->nullable();
            $table->date('due_date');
            $table->string('discount', 255)->nullable();
            $table->string('discount_type', 255)->nullable();
            $table->string('total', 255)->nullable();

            $table->index('purchase_order_detail_id', 'IDX_524E1BDE1BB0ABE7');
            $table->index('product_id', 'IDX_524E1BDE4584665A');
            $table->index('brand_id', 'IDX_524E1BDE44F5D008');
        });

        Schema::create('purchase_order_receivings', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('purchase_order_receiving_id')->unsigned();
            $table->string('quantity', 255)->nullable();
            $table->date('due_date');
            $table->string('discount', 255)->nullable();
            $table->string('discount_type', 255)->nullable();
            $table->string('total', 255)->nullable();

            $table->index('purchase_order_receiving_id', 'IDX_5C8888ED86DD02EF');
            $table->index('product_id', 'IDX_5C8888ED4584665A');
            $table->index('brand_id', 'IDX_5C8888ED44F5D008');
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->foreign('preferred_vendor_id', 'fk_purchase_orders_preferred_vendor_id_preferred_vendors')
                    ->references('id')
                    ->on('preferred_vendors')
                    ->onUpdate('cascade');
            $table->foreign('payment_term_id', 'fk_purchase_orders_payment_term_id_payment_terms')
                    ->references('id')
                    ->on('payment_terms')
                    ->onUpdate('cascade');
            $table->foreign('shipping_code_id', 'fk_purchase_orders_shipping_code_id_shipments')
                    ->references('id')
                    ->on('shipments')
                    ->onUpdate('cascade');
        });

        Schema::table('purchase_order_details', function (Blueprint $table) {
            $table->foreign('purchase_order_detail_id', 'fk_ba543e07abef7fe6eb5dad4298fc0cbd')
                    ->references('id')
                    ->on('purchase_orders')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('product_id', 'fk_purchase_order_details_product_id_products')
                    ->references('id')
                    ->on('products')
                    ->onUpdate('cascade');
            $table->foreign('brand_id', 'fk_purchase_order_details_brand_id_brands')
                    ->references('id')
                    ->on('brands')
                    ->onUpdate('cascade');
        });

        Schema::table('purchase_order_receivings', function (Blueprint $table) {
            $table->foreign('purchase_order_receiving_id', 'fk_e75719603161274b0269d07e5af38c20')
                    ->references('id')
                    ->on('purchase_orders')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('product_id', 'fk_purchase_order_receivings_product_id_products')
                    ->references('id')
                    ->on('products')
                    ->onUpdate('cascade');
            $table->foreign('brand_id', 'fk_purchase_order_receivings_brand_id_brands')
                    ->references('id')
                    ->on('brands')
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
        Schema::drop('purchase_order_receivings');
        Schema::drop('purchase_order_details');
        Schema::drop('purchase_orders');

    }
}
