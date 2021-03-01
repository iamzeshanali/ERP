<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OutboundLogistics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picking_work_areas', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->string('document', 255);
            $table->date('date')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Potential', 'Restricted', 'Warned'])->comment('(DC2Type:CustomEnum__Active__Inactive__Potential__Restricted__Warned)');
            $table->string('assigned_to', 255)->nullable();
            $table->string('branch', 255)->nullable();

            $table->index('customer_id', 'IDX_C2B0F9599395C3F3');
        });

        Schema::create('customer_shipments', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('sales_representative_id')->unsigned();
            $table->string('document', 255);
            $table->date('date')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Potential', 'Restricted', 'Warned'])->comment('(DC2Type:CustomEnum__Active__Inactive__Potential__Restricted__Warned)');
            $table->string('assigned_to', 255)->nullable();
            $table->string('po_number', 255)->nullable();

            $table->index('customer_id', 'IDX_3F9462CE9395C3F3');
            $table->index('sales_representative_id', 'IDX_3F9462CE8B54B08B');
        });

        Schema::create('customer_returns', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('sales_representative_id')->unsigned();
            $table->string('document', 255);
            $table->date('date')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Potential', 'Restricted', 'Warned'])->comment('(DC2Type:CustomEnum__Active__Inactive__Potential__Restricted__Warned)');
            $table->string('assigned_to', 255)->nullable();
            $table->string('po_number', 255)->nullable();

            $table->index('customer_id', 'IDX_97CBE81B9395C3F3');
            $table->index('sales_representative_id', 'IDX_97CBE81B8B54B08B');
        });

        Schema::create('sales_order_fulfillments', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('sales_order', 255);
            $table->date('date')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Potential', 'Restricted', 'Warned'])->comment('(DC2Type:CustomEnum__Active__Inactive__Potential__Restricted__Warned)');
            $table->string('part', 255)->nullable();
            $table->integer('so_qty')->nullable();
            $table->integer('available_amount');
            $table->string('available_currency', 5);
            $table->integer('packed')->nullable();
            $table->integer('shipped')->nullable();
            $table->integer('bo')->nullable();
            $table->integer('purchase_order')->nullable();
            $table->string('date2', 255)->nullable();
            $table->enum('status2', ['Active', 'Inactive', 'Potential', 'Restricted', 'Warned'])->comment('(DC2Type:CustomEnum__Active__Inactive__Potential__Restricted__Warned)')->nullable();
            $table->integer('po_qty')->nullable();
            $table->string('receiving', 255)->nullable();
            $table->string('date3', 255)->nullable();
            $table->enum('status3', ['Active', 'Inactive', 'Potential', 'Restricted', 'Warned'])->comment('(DC2Type:CustomEnum__Active__Inactive__Potential__Restricted__Warned)');
            $table->integer('pr_qty')->nullable();

        });

        Schema::table('picking_work_areas', function (Blueprint $table) {
            $table->foreign('customer_id', 'fk_picking_work_areas_customer_id_customers')
                    ->references('id')
                    ->on('customers')
                    ->onUpdate('cascade');
        });

        Schema::table('customer_shipments', function (Blueprint $table) {
            $table->foreign('customer_id', 'fk_customer_shipments_customer_id_customers')
                    ->references('id')
                    ->on('customers')
                    ->onUpdate('cascade');
            $table->foreign('sales_representative_id', 'fk_9ce3865d8274feb8adeb287336990940')
                    ->references('id')
                    ->on('sales_representatives')
                    ->onUpdate('cascade');
        });

        Schema::table('customer_returns', function (Blueprint $table) {
            $table->foreign('customer_id', 'fk_customer_returns_customer_id_customers')
                    ->references('id')
                    ->on('customers')
                    ->onUpdate('cascade');
            $table->foreign('sales_representative_id', 'fk_358ee3023157f2e944526e52c56f1bd8')
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
        Schema::drop('sales_order_fulfillments');
        Schema::drop('customer_returns');
        Schema::drop('customer_shipments');
        Schema::drop('picking_work_areas');

    }
}
