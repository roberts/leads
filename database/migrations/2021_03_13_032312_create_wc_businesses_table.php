<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWcBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wc_businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nature')->nullable();
            $table->string('fein')->nullable();
            $table->integer('year_of_establishment')->nullable();
            $table->string('legal_entity_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wc_businesses');
    }
}
