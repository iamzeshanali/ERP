<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShippingMaintenance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('code', 255);
            $table->text('description');
            $table->boolean('carrier_detail');

        });

        Schema::create('carriers_accounts', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('account_no', 255);
            $table->string('carrier_name', 255);
            $table->string('contact_name', 255);
            $table->string('company_name', 255);
            $table->string('address1', 255);
            $table->string('address2', 255)->nullable();
            $table->string('city', 255);
            $table->string('state', 255);
            $table->integer('zip');
            $table->string('country', 255)->nullable();
            $table->boolean('in_active');

        });

        Schema::create('shipment_lists', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->string('document', 255);
            $table->date('date')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Potential', 'Restricted', 'Warned'])->comment('(DC2Type:CustomEnum__Active__Inactive__Potential__Restricted__Warned)');
            $table->integer('rate_amount')->nullable();
            $table->string('rate_currency', 5)->nullable();
            $table->string('tracking_numbers', 255)->nullable();

            $table->index('customer_id', 'IDX_84EB3D009395C3F3');
        });

        Schema::table('shipment_lists', function (Blueprint $table) {
            $table->foreign('customer_id', 'fk_shipment_lists_customer_id_customers')
                    ->references('id')
                    ->on('customers')
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
        Schema::drop('shipment_lists');
        Schema::drop('carriers_accounts');
        Schema::drop('shipments');

    }
}
