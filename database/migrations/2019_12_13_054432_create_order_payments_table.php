<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {

            $table->bigIncrements       ('id');
            $table->unsignedBigInteger  ('restaurant_id');
            $table->unsignedBigInteger  ('order_id');
            $table->unsignedBigInteger  ('client_id')->nullable();
            $table->double              ('amount');
            $table->enum                ('method',['check','cash','creditcard'])->nullable();
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
        Schema::dropIfExists('order_payments');
    }
}
