<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('code');
            $table->string('prefix', 255);
            $table->text('description');
            $table->boolean('in_active');

        });

        Schema::create('pipeline_metrics', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('code');
            $table->string('prefix', 255);
            $table->text('description');
            $table->boolean('in_active');

        });

        Schema::create('typeof_sales', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('code');
            $table->text('description');
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
        Schema::drop('typeof_sales');
        Schema::drop('pipeline_metrics');
        Schema::drop('branches');

    }
}
