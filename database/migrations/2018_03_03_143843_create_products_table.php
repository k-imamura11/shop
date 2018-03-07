<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('discription');
            $table->text('detail');
            $table->text('image_url_1');
            $table->text('image_url_2');
            $table->text('image_url_3');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('genre')->default(0);
            $table->tinyInteger('hideflag')->default(0);
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
        Schema::dropIfExists('products');
    }
}
