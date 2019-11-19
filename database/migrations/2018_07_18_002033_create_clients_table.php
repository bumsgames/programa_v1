<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->string('nickname', 50)->unique();
            $table->string('email')->nullable()->unique();
            //$table->string('email')->default('SIN CORREO')->nullable();
            $table->string('image', 200)->default('sin-foto.jpg');
            $table->string('password', 200);
            $table->string('num_contact', 100)->default('** SIN NUMERO DE CONTACTO **')->nullable();
            $table->string('note', 500)->default('')->nullable();
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
