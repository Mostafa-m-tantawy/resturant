<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApproversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_approvers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('restaurant_id');

            $table->unsignedBigInteger('hr_employee_id');
//            $table->foreign('hr_employee_id')->references('id')->on('hr_employees')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('level');  // 1 is most level (strongest)

            $table->unsignedBigInteger('hr_approval_type_id');
//            $table->foreign('hr_approval_type_id')->references('id')->on('hr_approval_types')
//                ->onDelete('cascade')->onUpdate('cascade');

            $table->unique(['hr_employee_id', 'hr_approval_type_id']);


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
        Schema::dropIfExists('hr_approvers');
    }
}
