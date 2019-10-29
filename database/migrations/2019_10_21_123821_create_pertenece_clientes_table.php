<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerteneceClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertenece_clientes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_cliente')->unsigned();            
            $table->foreign('id_cliente')->references('id')->on('clients')
            ->onDelete('restrict');

            $table->integer('id_article')->unsigned()->nullable();            
            $table->foreign('id_article')->references('id')->on('articles')
            ->onUpdate('cascade')
            ->onDelete('cascade');


            $table->integer('id_venta')->unsigned()->nullable();            
            $table->foreign('id_venta')->references('id')->on('sales')
            ->onDelete('cascade');

            $table->integer('id_venta_oficial')->unsigned()->nullable();            
            $table->foreign('id_venta_oficial')->references('id')->on('ventas')
            ->onDelete('cascade');

            
            $table->string('informacion')->default('Sin informacion');

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
        Schema::dropIfExists('pertenece_clientes');
    }
}
