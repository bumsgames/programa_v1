<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_articulos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_venta')->unsigned();            
            $table->foreign('id_venta')->references('id')
            ->on('ventas')
            ->onDelete('cascade');

            $table->integer('id_articulo')->unsigned();            
            $table->foreign('id_articulo')->references('id')
            ->on('articles')
            ->onDelete('restrict');      

            $table->integer('cantidad')->unsigned(); 
            $table->float('costo_individual')->nullable();
            $table->float('precio_venta')->nullable();

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
        Schema::dropIfExists('venta_articulos');
    }
}
