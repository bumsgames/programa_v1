<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnviosPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envio__pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('empresa');
            $table->string('destinario');
            $table->string('cedula_destinario');
            $table->string('direccion');
            $table->string('telefono');

            $table->integer('id_pago')->unsigned()->nullable();            
            $table->foreign('id_pago')->references('id')->on('pagos')
            ->onUpdate('cascade')
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
        Schema::dropIfExists('envio__pagos');
    }
}
