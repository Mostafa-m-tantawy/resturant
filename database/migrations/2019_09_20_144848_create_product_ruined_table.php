<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductRuinedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruined_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ruined_header_id');
            $table->unsignedBigInteger('product_id');
            $table->double('quantity');
           $table->double('price_unit')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('ruined_products');
    }
}
