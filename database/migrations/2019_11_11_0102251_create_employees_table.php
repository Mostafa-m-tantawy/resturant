<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employees', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->unsignedInteger('user_id');
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('restaurant_id')->nullable();
//            $table->foreign('department_id')->references('id')->on('hr_departments');//->onDelete('cascade')->onUpdate('cascade');


            $table->string('photo')->nullable();

            $table->string('name');

            $table->enum('gender',['female','male'])->nullable();

            $table->string('civil_status')->nullable();

            $table->date('date_of_birth')->nullable();

            $table->date('date_of_joining')->nullable();

            $table->double('salary')->default(0)->nullable();

            $table->string('bank_account')->nullable();

            $table->string('bank_name')->nullable();

            $table->double('balance')->nullable();
            $table->dateTime('last_balance_update')->nullable();


            $table->softDeletes();

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
        Schema::dropIfExists('hr_employees');
    }
}
