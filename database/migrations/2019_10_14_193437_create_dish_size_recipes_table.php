<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishSizeRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_size_recipes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dish_size_id');
            $table->unsignedBigInteger('product_id');
            $table->double('unit_quantity');
            $table->double('child_unit_quantity')->nullable();

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
        Schema::dropIfExists('dish_size_recipes');
    }
}
