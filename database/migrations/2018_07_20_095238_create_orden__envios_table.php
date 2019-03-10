<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenEnviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden__envios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('articulo');
            $table->string('type_orden')->nullable();
            $table->string('status')->nullable();
            $table->integer('price')->nullable();
            $table->string('empresa')->nullable();
            $table->string('direccion')->nullable();
            $table->string('num_telefono')->nullable();
            $table->string('cedula')->nullable();
            $table->string('recibe')->nullable();
            $table->string('tracking')->nullable();

            $table->integer('id_cuenta')->unsigned()->nullable();
            $table->foreign('id_cuenta')->references('id')->on('cuentas')
            ->onDelete('restrict');

            $table->integer('id_recibeUsuario')->unsigned()->nullable();
            $table->foreign('id_recibeUsuario')->references('id')->on('bums_users')
            ->onDelete('restrict');

            $table->integer('envia_Usuario')->unsigned()->nullable();
            $table->foreign('envia_Usuario')->references('id')->on('bums_users')
            ->onDelete('restrict');

            $table->integer('id_creadoUsuario')->unsigned()->nullable();
            $table->foreign('id_creadoUsuario')->references('id')->on('bums_users')
            ->onDelete('restrict');

            $table->integer('id_Venta')->unsigned()->nullable();
            $table->foreign('id_Venta')->references('id')->on('sales')
            ->onDelete('cascade');

            $table->integer('id_movimiento')->unsigned()->nullable();
            $table->foreign('id_movimiento')->references('id')->on('movimientos')
            ->onDelete('cascade');

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
        Schema::dropIfExists('orden__envios');
    }
}
