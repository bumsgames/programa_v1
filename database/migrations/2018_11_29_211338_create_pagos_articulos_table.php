<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago__articulos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_pago')->unsigned();            
            $table->foreign('id_pago')->references('id')->on('pagos')
            ->onDelete('cascade');

            $table->integer('id_article')->unsigned();            
            $table->foreign('id_article')->references('id')->on('articles')
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
        Schema::dropIfExists('pago__articulos');
    }
}
