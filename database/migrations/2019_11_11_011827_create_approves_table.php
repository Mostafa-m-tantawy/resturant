<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_approves', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('hr_approver_id');
//            $table->foreign('hr_approver_id')->references('id')->on('hr_approvers')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('hr_approval_request_id');
//            $table->foreign('hr_approval_request_id')->references('id')->on('hr_approval_requests')
//                ->onDelete('cascade')->onUpdate('cascade');

            $table->unique(['hr_approver_id', 'hr_approval_request_id']);

            $table->enum('status',['accepted','rejected','modified']);
            $table->text('comment')->nullable();

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
        Schema::dropIfExists('hr_approves');
    }
}
