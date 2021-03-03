<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Brands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('code', 255)->nullable();
            $table->text('description')->nullable();
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
        Schema::drop('brands');

    }
}
