<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignStockDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_stock_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('assign_stock_id');
            $table->unsignedInteger('product_id');
            $table->double('quantity');
            $table->double('unit_price')->nullable();;
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
        Schema::dropIfExists('assign_stock_details');
    }
}
