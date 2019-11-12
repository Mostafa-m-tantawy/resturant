<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmergencyContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_emergency_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('hr_employee_id');
//            $table->foreign('hr_employee_id')->references('id')->on('hr_employees')->onDelete('cascade')->onUpdate('cascade');

            $table->string('name');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('relationship')->nullable();;

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
        Schema::dropIfExists('hr_emergency_contacts');
    }
}
