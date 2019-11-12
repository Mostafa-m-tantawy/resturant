<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_approval_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id');

            $table->string('name');

            $table->unsignedBigInteger('hr_employee_id')->nullable();
//            $table->foreign('hr_employee_id')->references('id')->on('hr_employees')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('hr_approval_type_id');
//            $table->foreign('hr_approval_type_id')->references('id')->on('hr_approval_types')
//                ->onDelete('cascade')->onUpdate('cascade');

            $table->text('subject');

            $table->text('details');

            $table->enum('status',['accepted','rejected','pending','modified'])->default('pending');

            $table->morphs('approvable');

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
        Schema::dropIfExists('hr_approval_requests');
    }
}
