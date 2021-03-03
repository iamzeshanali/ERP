<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_packs', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('code', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('units_per_pack', 255)->nullable();
            $table->enum('status', ['active', 'inactive'])->comment('(DC2Type:CustomEnum__active__inactive)')->nullable();

        });

        Schema::create('families', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('code', 255);
            $table->string('description', 255)->nullable();
            $table->enum('status', ['active', 'inactive'])->comment('(DC2Type:CustomEnum__active__inactive)')->nullable();

        });

        Schema::create('groups', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('code', 255);
            $table->string('description', 255)->nullable();
            $table->enum('status', ['active', 'inactive'])->comment('(DC2Type:CustomEnum__active__inactive)')->nullable();

        });

        Schema::create('uoms', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('code', 255);
            $table->string('quantity', 255);
            $table->enum('unit', ['oz', 'ml', 'pints', 'quars', 'liter', 'gallon'])->comment('(DC2Type:CustomEnum__oz__ml__pints__quars__liter__gallon)');
            $table->enum('status', ['active', 'inactive'])->comment('(DC2Type:CustomEnum__active__inactive)');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('uoms');
        Schema::drop('groups');
        Schema::drop('families');
        Schema::drop('case_packs');

    }
}
