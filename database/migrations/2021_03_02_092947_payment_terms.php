<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentTerms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_terms', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('code', 255)->nullable();
            $table->text('term_description')->nullable();
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
        Schema::drop('payment_terms');

    }
}
