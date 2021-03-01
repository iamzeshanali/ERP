<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalesTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('sales_representative_id')->unsigned();
            $table->string('document', 255);
            $table->date('date')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Potential', 'Restricted', 'Warned'])->comment('(DC2Type:CustomEnum__Active__Inactive__Potential__Restricted__Warned)');
            $table->string('assigned_to', 255)->nullable();
            $table->integer('final_price_amount');
            $table->string('final_price_currency', 5);

            $table->index('customer_id', 'IDX_A9F48EAE9395C3F3');
            $table->index('sales_representative_id', 'IDX_A9F48EAE8B54B08B');
        });

        Schema::create('sales_orders', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('sales_representative_id')->unsigned();
            $table->string('document', 255);
            $table->date('date')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Potential', 'Restricted', 'Warned'])->comment('(DC2Type:CustomEnum__Active__Inactive__Potential__Restricted__Warned)');
            $table->string('assigned_to', 255)->nullable();
            $table->string('po_number', 255)->nullable();
            $table->integer('final_price_amount');
            $table->string('final_price_currency', 5);

            $table->index('customer_id', 'IDX_C7DBAFE69395C3F3');
            $table->index('sales_representative_id', 'IDX_C7DBAFE68B54B08B');
        });

        Schema::table('quotations', function (Blueprint $table) {
            $table->foreign('customer_id', 'fk_quotations_customer_id_customers')
                    ->references('id')
                    ->on('customers')
                    ->onUpdate('cascade');
            $table->foreign('sales_representative_id', 'fk_quotations_sales_representative_id_sales_representatives')
                    ->references('id')
                    ->on('sales_representatives')
                    ->onUpdate('cascade');
        });

        Schema::table('sales_orders', function (Blueprint $table) {
            $table->foreign('customer_id', 'fk_sales_orders_customer_id_customers')
                    ->references('id')
                    ->on('customers')
                    ->onUpdate('cascade');
            $table->foreign('sales_representative_id', 'fk_sales_orders_sales_representative_id_sales_representatives')
                    ->references('id')
                    ->on('sales_representatives')
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
        Schema::drop('sales_orders');
        Schema::drop('quotations');

    }
}
