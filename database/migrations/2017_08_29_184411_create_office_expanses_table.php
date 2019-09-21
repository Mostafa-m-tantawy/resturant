<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeExpansesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_expanses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->double('amount');
            $table->string('method');
            $table->string('file_id');
            $table->string('payment_method');
            $table->unsignedInteger('restaurant_id');
            $table->unsignedInteger('user_id');

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
        Schema::dropIfExists('office_expanses');
    }
}
