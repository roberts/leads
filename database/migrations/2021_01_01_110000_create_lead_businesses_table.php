<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Roberts\Leads\Models\Lead;

class CreateLeadBusinessesTable extends Migration
{
    public function up()
    {
        Schema::create('lead_businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nature')->nullable();
            $table->string('fein')->nullable();
            $table->string('payroll')->nullable();
            $table->integer('year_of_establishment')->nullable();
            $table->string('legal_entity_type')->nullable();
            $table->foreignIdFor(Lead::class); // moving to other table to reverse the relationship
            $table->timestamps();
        });
    }
}
