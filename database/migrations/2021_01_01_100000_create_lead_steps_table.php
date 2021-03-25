<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Roberts\Leads\Models\LeadType;

class CreateLeadStepsTable extends Migration
{
    public function up()
    {
        Schema::create('lead_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LeadType::class);
            $table->timestamps();
        });
    }
}
