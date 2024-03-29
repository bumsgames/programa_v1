<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBancoEmisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banco_emisors', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_coin')->nullable()->unsigned();            

            $table->foreign('id_coin')->references('id')->on('coins')
            ->onDelete('restrict');
            $table->string('titular');
             $table->string('cuentaBancaria');
             $table->integer('active')->unsigned()->default(1);
            $table->string('tipo_cuenta')->default('NO APLICA');
            $table->string('cedula')->default('NO APLICA');;
             $table->string('nota')->nullable();
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
        Schema::dropIfExists('banco_emisors');
    }
}
