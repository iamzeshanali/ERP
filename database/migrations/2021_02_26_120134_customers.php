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
        Schema::create('sales_representatives', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('code', 255);
            $table->string('first_name', 255);
            $table->string('last_name', 255)->nullable();
            $table->decimal('commission', 16, 8);
            $table->string('phone', 255)->nullable();
            $table->string('cell', 255)->nullable();
            $table->string('email', 254)->nullable();
            $table->boolean('in_active');

        });

        Schema::create('customers_groups', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('code');
            $table->text('description');
            $table->boolean('in_active');

        });

        Schema::create('customers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('sales_representative_id')->unsigned();
            $table->integer('customers_groups_id')->unsigned();
            $table->string('number', 255);
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->enum('status', ['Active', 'Inactive', 'Potential', 'Restricted', 'Warned'])->comment('(DC2Type:CustomEnum__Active__Inactive__Potential__Restricted__Warned)');
            $table->string('tax', 255);
            $table->string('address', 255);
            $table->string('city', 255);
            $table->string('state', 255);
            $table->integer('zip');
            $table->string('country', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('fax', 255)->nullable();
            $table->string('email', 254)->nullable();

            $table->index('sales_representative_id', 'IDX_62534E218B54B08B');
            $table->index('customers_groups_id', 'IDX_62534E2133E48540');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('sales_representative_id', 'fk_customers_sales_representative_id_sales_representatives')
                    ->references('id')
                    ->on('sales_representatives')
                    ->onUpdate('cascade');
            $table->foreign('customers_groups_id', 'fk_customers_customers_groups_id_customers_groups')
                    ->references('id')
                    ->on('customers_groups')
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
        Schema::drop('customers_groups');
        Schema::drop('sales_representatives');

    }
}
