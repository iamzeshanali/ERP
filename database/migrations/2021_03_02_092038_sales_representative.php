<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalesRepresentative extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_representatives', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('code', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('cell', 255)->nullable();
            $table->string('email', 254)->nullable();
            $table->enum('status', ['active', 'inactive'])->comment('(DC2Type:CustomEnum__active__inactive)')->nullable();

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales_representatives');

    }
}
