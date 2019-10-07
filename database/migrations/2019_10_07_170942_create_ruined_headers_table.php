<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRuindHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruined_headers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('ruinedable_id');
            $table->unsignedInteger('ruinedable_id');
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
        Schema::dropIfExists('ruind_headers');
    }
}
