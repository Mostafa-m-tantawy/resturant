<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_asset_employee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id');

            $table->unsignedBigInteger('hr_employee_id');
//            $table->foreign('hr_employee_id')->references('id')->on('hr_employees')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('asset_id');
//            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade')->onUpdate('cascade');

            $table->date('date_of_assignment');
            $table->date('date_of_release');

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
        Schema::dropIfExists('hr_asset_employee');
    }
}
