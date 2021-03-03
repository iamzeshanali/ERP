<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalesInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('sales_representative_id')->unsigned();
            $table->integer('shipping_code_id')->unsigned();
            $table->integer('payment_terms_id')->unsigned();
            $table->integer('warehouse_id')->unsigned();
            $table->date('date');
            $table->string('invoice_number', 255);
            $table->enum('status', ['draft', 'inProgress', 'posted', 'cancel'])->comment('(DC2Type:CustomEnum__draft__inProgress__posted__cancel)');
            $table->string('shipping_address_line1', 255)->nullable();
            $table->string('shipping_address_line2', 255)->nullable();
            $table->string('shipping_state', 255)->nullable();
            $table->string('shipping_zip', 255)->nullable();
            $table->string('shipping_city', 255)->nullable();
            $table->string('shipping_country', 255)->nullable();
            $table->string('profit_in_percent', 255)->nullable();
            $table->string('profit_in_dollar', 255)->nullable();
            $table->string('total', 255)->nullable();
            $table->string('discount_in_percent', 255)->nullable();
            $table->string('discount_in_dollar', 255)->nullable();
            $table->string('total_after_discount', 255)->nullable();
            $table->string('total_tax', 255)->nullable();
            $table->string('final_price', 255)->nullable();

            $table->index('customer_id', 'IDX_2793B7B19395C3F3');
            $table->index('sales_representative_id', 'IDX_2793B7B18B54B08B');
            $table->index('shipping_code_id', 'IDX_2793B7B1C192F8D3');
            $table->index('payment_terms_id', 'IDX_2793B7B113B26D4F');
            $table->index('warehouse_id', 'IDX_2793B7B15080ECDE');
        });

        Schema::create('sales_invoice_details', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('sales_invoice_id')->unsigned();
            $table->string('quantity', 255)->nullable();
            $table->string('price', 255)->nullable();
            $table->string('availability', 255)->nullable();
            $table->date('due_date');
            $table->string('discount', 255)->nullable();
            $table->string('discount_type', 255)->nullable();
            $table->string('total', 255)->nullable();

            $table->index('sales_invoice_id', 'IDX_F671D10D26B54691');
            $table->index('product_id', 'IDX_F671D10D4584665A');
            $table->index('brand_id', 'IDX_F671D10D44F5D008');
        });

        Schema::table('sales_invoices', function (Blueprint $table) {
            $table->foreign('customer_id', 'fk_sales_invoices_customer_id_customers')
                    ->references('id')
                    ->on('customers')
                    ->onUpdate('cascade');
            $table->foreign('sales_representative_id', 'fk_sales_invoices_sales_representative_id_sales_representatives')
                    ->references('id')
                    ->on('sales_representatives')
                    ->onUpdate('cascade');
            $table->foreign('shipping_code_id', 'fk_sales_invoices_shipping_code_id_shipments')
                    ->references('id')
                    ->on('shipments')
                    ->onUpdate('cascade');
            $table->foreign('payment_terms_id', 'fk_sales_invoices_payment_terms_id_payment_terms')
                    ->references('id')
                    ->on('payment_terms')
                    ->onUpdate('cascade');
            $table->foreign('warehouse_id', 'fk_sales_invoices_warehouse_id_warehouses')
                    ->references('id')
                    ->on('warehouses')
                    ->onUpdate('cascade');
        });

        Schema::table('sales_invoice_details', function (Blueprint $table) {
            $table->foreign('sales_invoice_id', 'fk_sales_invoice_details_sales_invoice_id_sales_invoices')
                    ->references('id')
                    ->on('sales_invoices')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('product_id', 'fk_sales_invoice_details_product_id_products')
                    ->references('id')
                    ->on('products')
                    ->onUpdate('cascade');
            $table->foreign('brand_id', 'fk_sales_invoice_details_brand_id_brands')
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
        Schema::drop('sales_invoice_details');
        Schema::drop('sales_invoices');

    }
}
