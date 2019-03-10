<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('note', 500)->nullable();

            //FK
            $table->integer('id_vendedor')->unsigned();            
            $table->foreign('id_vendedor')->references('id')->on('bums_users')
            ->onDelete('restrict');

            $table->integer('id_article')->unsigned();            
            $table->foreign('id_article')->references('id')->on('articles')
            ->onDelete('restrict');

            $table->integer('id_client')->unsigned();            
            $table->foreign('id_client')->references('id')->on('clients')
            ->onDelete('restrict');

            $table->integer('id_movimiento')->unsigned();
            $table->foreign('id_movimiento')->references('id')->on('movimientos')
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
        Schema::dropIfExists('sales');
    }
}
