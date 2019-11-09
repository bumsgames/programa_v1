<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entidad', 100);
            $table->string('correo', 100);
            $table->string('password', 100)->default('Sin clave registrada')->nullable();
            $table->string('note_cuenta', 500)->nullable();
            $table->integer('id_coin');
            $table->integer('price');

            //FK
            $table->integer('id_bumsuser')->unsigned();
            $table->foreign('id_bumsuser')->references('id')->on('bums_users')
            ->onDelete('restrict');

            

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
        Schema::dropIfExists('cuentas');
    }
}
