<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id');
            $table->double('discount')->default(0)->nullable();
            $table->double('service')->default(0)->nullable();
            $table->double('vat')->default(0)->nullable();
            $table->double('delivery')->default(0)->nullable();
            $table->boolean('is_staff')->default(0)->nullable();
            $table->string('coupon')->default(0)->nullable();
            $table->enum('type',['restaurant','delivery','takeaway'])->nullable();
            $table->enum('status',['pending','cooking','completed','closed'])->default('pending')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
