<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements          ('id');
            $table->double              ('payment_amount');
            $table->string              ('payment_method');
            $table->unsignedBigInteger     ('sender_id');
//            $table->string              ('sender_type');
            $table->unsignedBigInteger     ('receiver_id');
//            $table->string              ('receiver_type');
            $table->string              ('note')->nullable();
            $table->date                ('due_date')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
