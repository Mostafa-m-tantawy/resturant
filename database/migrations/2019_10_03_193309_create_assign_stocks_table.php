<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('restaurant_id');
            $table->unsignedInteger('assignable_id');
            $table->string('assignable_type');
            $table->string('price_math_method')->nullable();;
            $table->date('math_start_date')->nullable();
            $table->date('math_end_date')->nullable();
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
        Schema::dropIfExists('assign_stocks');
    }
}
