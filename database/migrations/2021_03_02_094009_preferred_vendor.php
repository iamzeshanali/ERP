<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PreferredVendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferred_vendors', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('payment_terms_id')->unsigned();
            $table->string('vendor_number', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('address_line1', 255)->nullable();
            $table->string('address_line2', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('email', 254)->nullable();
            $table->string('website', 2083)->nullable();
            $table->string('license_number', 255)->nullable();
            $table->enum('status', ['active', 'inactive'])->comment('(DC2Type:CustomEnum__active__inactive)')->nullable();

            $table->index('payment_terms_id', 'IDX_E5D690CE13B26D4F');
        });

        Schema::table('preferred_vendors', function (Blueprint $table) {
            $table->foreign('payment_terms_id', 'fk_preferred_vendors_payment_terms_id_payment_terms')
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
        Schema::drop('preferred_vendors');

    }
}
