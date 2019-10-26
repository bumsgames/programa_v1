<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaPagoInvolucradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta__pago_involucrados', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_ventaArticulo')->unsigned();            
            $table->foreign('id_ventaArticulo')->references('id')
            ->on('venta_articulos')
            ->onDelete('cascade');

            $table->integer('id_agente')->unsigned();            
            $table->foreign('id_agente')->references('id')
            ->on('bums_users')
            ->onDelete('restrict');

            $table->float('porcentajeInvolucrado');
            $table->float('porcentajeInversion');
            $table->string('descripcionInvolucrado');
            $table->integer('cobrado_boolean')->unsigned()->default(0);

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
        Schema::dropIfExists('venta__pago_involucrados');
    }
}
