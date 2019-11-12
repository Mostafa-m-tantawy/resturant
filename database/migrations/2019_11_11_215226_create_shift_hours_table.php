<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_shift_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id');

            $table->unsignedBigInteger('hr_shift_id');
//            $table->foreign('hr_shift_id')->references('id')->on('hr_shifts')->onDelete('cascade')->onUpdate('cascade');

            $table->enum('start_day',['sat','sun','mon','tues','wend','thurs','fri']);
            $table->time('start_time');

            $table->enum('end_day',['sat','sun','mon','tues','wend','thurs','fri']);
            $table->time('end_time');

            $table->unique(['hr_shift_id', 'start_day']);

//            $table->unsignedBigInteger('parent_id');

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
        Schema::dropIfExists('hr_shift_hours');
    }
}
