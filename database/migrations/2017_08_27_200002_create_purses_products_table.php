<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePursesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purses_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purse_id');
            $table->unsignedBigInteger('product_id');
            $table->double('quantity');
            $table->double('unit_price');
            $table->double('vat')->default(0)->nullable();  //vat percentage
            $table->date('expired_date')->nullable();
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
        Schema::dropIfExists('purses_products');
    }
}
