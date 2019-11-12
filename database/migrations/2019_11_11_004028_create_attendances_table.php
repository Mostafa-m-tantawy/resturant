<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id');

            $table->unsignedBigInteger('file_id')->nullable();
//            $table->foreign('file_id')->references('id')->on('hr_attendance_files')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('hr_employee_id');
//            $table->foreign('employee_id')->references('id')->on('hr_employees')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('hr_shift_hour_id');
//            $table->foreign('hr_shift_hour_id')->references('id')->on('hr_shift_hours')->onDelete('cascade')->onUpdate('cascade');

            $table->date('attendance_date');

            $table->time('check_in');
            $table->time('check_out');


            $table->unique(['hr_employee_id','attendance_date', 'check_in']);

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
        Schema::dropIfExists('hr_attendances');
    }
}
