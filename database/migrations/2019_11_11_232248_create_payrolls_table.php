<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_payrolls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id');

            $table->unsignedBigInteger('hr_payroll_type_id');
//            $table->foreign('hr_payroll_type_id')->references('id')->on('hr_payroll_types')->onDelete('cascade')->onUpdate('cascade');

            $table->date('from');
            $table->date('to');

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
        Schema::dropIfExists('hr_payrolls');
    }
}
