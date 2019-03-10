<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 200);
             $table->string('entidad', 200);
            $table->integer('price');
            $table->integer('cantidad');
            $table->integer('comision')->nullable();
            $table->string('note_movimiento', 255)->default('Sin descripcion')->nullable();
            $table->string('referencia', 100)->default('** SIN DESCRIPCION **')->nullable();
            $table->string('type', 100);

            //FK
            $table->integer('id_coin')->unsigned();            
            $table->foreign('id_coin')->references('id')->on('coins')
            ->onDelete('restrict');
            $table->integer('dolardia')->unsigned()->nullable();
            $table->timestamps();
            
        });
    }

    // $table->increments('id');
    //         $table->integer('id_user_que_vende')->unsigned();            
    //         $table->foreign('id_user_que_vende')->references('id')->on('bums_users');
    //         $table->integer('id_user_duenno_articulo')->unsigned();            
    //         $table->foreign('id_user_duenno_articulo')->references('id')->on('bums_users');
    //         $table->integer('id_article')->unsigned()->default('1');            
    //         $table->foreign('id_article')->references('id')->on('articles');
    //         $table->integer('id_client')->unsigned()->default('1');            
    //         $table->foreign('id_client')->references('id')->on('clients');
    //         $table->string('description', 200)->default('** SIN DESCRIPCION **')->nullable();
    //         $table->string('reference', 100)->default('** SIN REFERENCIA **')->nullable();
    //         $table->integer('price');
    //         $table->integer('commission')->unsigned()->default('0');
    //         $table->string('coin', 100);
    //         $table->string('type', 100);
    //         $table->string('movement', 100)->default('personal');
    //         $table->string('note_sale', 100)->default('** SIN NOTA **')->nullable();
    //         $table->timestamps(); 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
