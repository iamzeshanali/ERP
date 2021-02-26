<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Warehouses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('code', 255);
            $table->text('description');
            $table->string('branch', 255)->nullable();
            $table->string('address1', 255);
            $table->string('address2', 255)->nullable();
            $table->string('city', 255);
            $table->string('state', 255);
            $table->integer('zip');
            $table->string('country', 255)->nullable();
            $table->boolean('inventory_valued');
            $table->boolean('include_mrp');
            $table->boolean('sales_warehouse');
            $table->integer('balance_amount');
            $table->string('balance_currency', 5);
            $table->boolean('in_active');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('warehouses');

    }
}
