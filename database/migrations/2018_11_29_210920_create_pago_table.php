<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_v2', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('ws', 30);
            $table->string('tipo_trans');
            $table->string('banco');
            $table->string('cedula');
            $table->string('referencia');
            $table->string('nota_adicional')->nullable();
            
            $table->date('fecha');
            $table->string('monto');
            $table->string('image', 200)->default('none.jpg');

            $table->integer('verificado');
            $table->integer('id_user')->unsigned()->nullable();            
            $table->foreign('id_user')->references('id')->on('bums_users')
            ->onUpdate('restrict')
            ->onDelete('restrict');

            $table->integer('entregado');
            $table->integer('id_user2')->unsigned()->nullable();            
            $table->foreign('id_user2')->references('id')->on('bums_users')
            ->onUpdate('restrict')
            ->onDelete('restrict');

            $table->integer('cupon_id')->unsigned()->nullable();
            $table->foreign('cupon_id')->references('id')->on('coupon')
            ->onUpdate('restrict')
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
        Schema::dropIfExists('pagos_v2');
    }
}
