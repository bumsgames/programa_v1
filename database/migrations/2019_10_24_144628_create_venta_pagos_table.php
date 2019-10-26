<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_venta')->unsigned();            
            $table->foreign('id_venta')->references('id')
            ->on('ventas')
            ->onDelete('cascade');

            $table->integer('id_bancoEmisor')->unsigned();            
            $table->foreign('id_bancoEmisor')->references('id')
            ->on('banco_emisor')
            ->onDelete('restrict');


            $table->float('monto', 15, 2); 
            $table->integer('id_coin')->unsigned();            
            $table->foreign('id_coin')->references('id')->on('coins')
            ->onDelete('restrict');
            $table->integer('dolardia')->unsigned()->nullable();
            $table->string('referencia');
            $table->string('capture', 300)->default('nada.jpg');
            
            $table->string('notaPago');
            
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
        Schema::dropIfExists('venta_pagos');
    }
}
