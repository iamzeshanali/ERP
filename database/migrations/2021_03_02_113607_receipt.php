<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Receipt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->string('cash', 255)->nullable();
            $table->string('receipt_number', 255)->nullable();
            $table->date('date');
            $table->enum('status', ['draft', 'checking', 'finalized', 'cancel'])->comment('(DC2Type:CustomEnum__draft__checking__finalized__cancel)');
            $table->string('total_received', 255)->nullable();
            $table->string('amount_due', 255)->nullable();
            $table->string('balance_due', 255)->nullable();

            $table->index('customer_id', 'IDX_1DEBE3A29395C3F3');
        });

        Schema::table('receipts', function (Blueprint $table) {
            $table->foreign('customer_id', 'fk_receipts_customer_id_customers')
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
        Schema::drop('receipts');

    }
}
