<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_sizes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_color_id')->unsigned()->index();
            $table->foreign('product_color_id')->references('id')->on('product_colors')->onDelete('cascade');
            $table->string('size');
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
        Schema::dropIfExists('color_sizes');
    }
}
