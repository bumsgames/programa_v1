<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_vendedor')->unsigned();            
            $table->foreign('id_vendedor')->references('id')
            ->on('bums_users')
            ->onDelete('restrict');

            $table->integer('id_cliente')->unsigned();            
            $table->foreign('id_cliente')->references('id')
            ->on('clients')
            ->onDelete('restrict');

            $table->integer('id_envio')->unsigned()->nullable();            
            $table->foreign('id_envio')->references('id')
            ->on('clients')
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
        Schema::dropIfExists('ventas');
    }
}
