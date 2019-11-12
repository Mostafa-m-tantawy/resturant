<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEarningDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_earning_deductions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('hr_payslip_id');
//            $table->foreign('payslip_id')->references('id')->on('hr_payslips')->onDelete('cascade')->onUpdate('cascade');

            $table->string('earn_deductable_type')->nullable();

            $table->integer('earn_deductable_id')->nullable();

            $table->decimal('amount')->default(0);
            $table->text('reason')->nullable();

            $table->enum('type',['earning','deduction'])->default('earning');

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
        Schema::dropIfExists('hr_earning_deductions');
    }
}
