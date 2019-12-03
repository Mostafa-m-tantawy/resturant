<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEDDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_e_d_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('hr_payslip_id');
            $table->unsignedBigInteger('hr_earning_deduction_id');
            $table->double('amount')->default(0)->nullable();
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('hr_e_d_details');
    }
}
