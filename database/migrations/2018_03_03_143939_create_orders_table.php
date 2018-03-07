<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigend();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('user_name', 255)->unsigend();
            $table->foreign('user_name')->references('name')->on('users');
            $table->string('user_email', 255)->unsigend();
            $table->foreign('user_email')->references('email')->on('users');
            $table->string('user_address', 255)->unsigend();
            $table->foreign('user_address')->references('address')->on('users');
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
        Schema::dropIfExists('orders');
    }
}
