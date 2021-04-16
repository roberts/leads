<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Roberts\Leads\Models\LeadStep;

class CreateLeadFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('lead_fields', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('name');
            $table->string('rules');
            $table->string('type');
            $table->unsignedInteger('position');
            $table->foreignIdFor(LeadStep::class);
            $table->timestamps();
        });
    }
}
