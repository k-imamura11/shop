<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name', 255);
          $table->string('email', 255)->unique();
          $table->text('password');
          $table->string('address', 255);

          $table->integer('phone_number')->nullable();
          $table->integer('address_number')->nullable();
          $table->integer('born')->nullable();

          $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
