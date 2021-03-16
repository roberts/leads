<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWcLeadsTable extends Migration
{
    public function up()
    {
        Schema::create('wc_leads', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('position')->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('current_plan_under_cancellation')->nullable();
            $table->date('current_plan_expires_at')->nullable();
            $table->text('past_comp_claims')->nullable();
            $table->unsignedBigInteger('wc_business_id');
            $table->timestamps();
        });
    }
}
