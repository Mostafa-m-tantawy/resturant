<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpPayrollTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_emp_payroll_types', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('hr_payroll_type_id');
//            $table->foreign('hr_payroll_type_id')->references('id')->on('hr_payroll_types')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('hr_employee_id');
//            $table->foreign('hr_employee_id')->references('id')->on('hr_employees')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('hr_emp_payroll_types');
    }
}
