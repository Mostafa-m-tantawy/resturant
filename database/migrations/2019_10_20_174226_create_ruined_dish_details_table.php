<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRuinedDishDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruined_dish_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ruined_dish_id');
            $table->unsignedBigInteger('dish_size_id');
            $table->double('unit_price')->nullable();
            $table->double('quantity')->nullable();
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
        Schema::dropIfExists('ruined_dish_details');
    }
}
