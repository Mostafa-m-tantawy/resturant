<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturndetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returndetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('return_header_id');
            $table->unsignedInteger('product_id');
            $table->double('quantity')->nullable();;
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
        Schema::dropIfExists('returndetails');
    }
}
