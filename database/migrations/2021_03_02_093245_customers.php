<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('sales_representative_id')->unsigned();
            $table->integer('payment_terms_id')->unsigned();
            $table->string('customer_name', 255)->nullable();
            $table->string('customer_number', 255)->nullable();
            $table->string('email', 254)->nullable();
            $table->enum('customer_status', ['potential', 'active', 'restricted', 'inactive'])->comment('(DC2Type:CustomEnum__potential__active__restricted__inactive)')->nullable();
            $table->string('address_line1', 255)->nullable();
            $table->string('address_line2', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->boolean('is_shipping_same')->nullable();
            $table->string('shipping_address_line1', 255)->nullable();
            $table->string('shipping_address_line2', 255)->nullable();
            $table->string('shipping_state', 255)->nullable();
            $table->string('shipping_zip', 255)->nullable();
            $table->string('shipping_city', 255)->nullable();
            $table->string('shipping_country', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('bev_licence_number', 255)->nullable();
            $table->string('number_of_pallets', 255)->nullable();

            $table->index('sales_representative_id', 'IDX_62534E218B54B08B');
            $table->index('payment_terms_id', 'IDX_62534E2113B26D4F');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('sales_representative_id', 'fk_customers_sales_representative_id_sales_representatives')
                    ->references('id')
                    ->on('sales_representatives')
                    ->onUpdate('cascade');
            $table->foreign('payment_terms_id', 'fk_customers_payment_terms_id_payment_terms')
                    ->references('id')
                    ->on('payment_terms')
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
        Schema::drop('customers');

    }
}
