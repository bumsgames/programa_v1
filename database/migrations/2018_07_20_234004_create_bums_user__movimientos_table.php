<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBumsUserMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bums_user__movimientos', function (Blueprint $table) {
            $table->increments('id');
            //fk
            $table->integer('movimiento_usuario')->unsigned();
            $table->foreign('movimiento_usuario')->references('id')->on('bums_users')
            ->onDelete('restrict');

            $table->integer('id_movimiento')->unsigned();        
            $table->foreign('id_movimiento')->references('id')->on('movimientos')
            ->onDelete('cascade');

            $table->integer('id_cuenta')->unsigned()->nullable();
            $table->foreign('id_cuenta')->references('id')->on('cuentas')
            ->onDelete('cascade');

            $table->integer('id_venta')->unsigned()->nullable();
            $table->foreign('id_venta')->references('id')->on('sales')
            ->onDelete('cascade');

            
            $table->integer('porcentaje')->unsigned()->default('0');
            $table->integer('permiso')->unsigned()->default('0');
            $table->string('descripcion_movimiento')->nullable();

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
        Schema::dropIfExists('bums_user__movimientos');
    }
}
