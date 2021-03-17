<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWcPayrollClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wc_payroll_classifications', function (Blueprint $table) {
            $table->id();
            $table->string('class_code');
            $table->integer('number_of_employees');
            $table->decimal('annual_payroll',12,3);
            $table->unsignedBigInteger('wc_lead_id');
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
        Schema::dropIfExists('wc_payroll_classifications');
    }
}
