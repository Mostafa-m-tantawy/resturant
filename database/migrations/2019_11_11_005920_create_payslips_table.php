<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_payslips', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('restaurant_id');

            $table->unsignedBigInteger('hr_payroll_id');
//            $table->foreign('hr_payroll_id')->references('id')->on('hr_payrolls')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('hr_employee_id');
//            $table->foreign('hr_employee_id')->references('id')->on('hr_employees')->onDelete('cascade')->onUpdate('cascade');

            $table->decimal('basic_salary')->default(0)->nullable();
            $table->decimal('total_earning')->default(0)->nullable();
            $table->decimal('total_deduction')->default(0)->nullable();;
            $table->decimal('net_salary')->default(0)->nullable();

            $table->integer('leave')->default(0)->nullable();;
            $table->integer('holiday')->default(0)->nullable();;

            $table->double('insurance')->default(0)->nullable();
            $table->double('taxes')->default(0)->nullable();

            $table->unique(['hr_payroll_id', 'hr_employee_id']);

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
        Schema::dropIfExists('hr_payslips');
    }
}
