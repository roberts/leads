<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWcPayrollClassificationsTable extends Migration
{
    public function up()
    {
        Schema::create('wc_payroll_classifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wc_lead_id');
            $table->string('description')->nullable();
            $table->string('class_code')->nullable();
            $table->integer('number_of_employees')->nullable();
            $table->integer('annual_payroll')->nullable(); // Stored in dollar amount
            $table->timestamps();
        });
    }
}
