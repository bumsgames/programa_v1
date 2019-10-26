<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBumsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bums_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('lastname', 100);
            $table->string('nickname', 50)->unique();
            $table->string('email')->unique();
            $table->integer('level')->default(5);
            $table->string('image', 200)->default('none.jpg');
            $table->string('password', 200)->default(bcrypt(1234));
            $table->float('porcentaje_ventaPropia');
            $table->float('porcentaje_ventaParcial');
            $table->float('porcentaje_ventaAjena');

            $table->float('porcentaje_ventaPorOtraPersona');
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
        Schema::dropIfExists('bums_users');
    }
}
