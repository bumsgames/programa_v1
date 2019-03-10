<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Coupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('descuento')->unsigned();            
            $table->integer('disponible')->unsigned();   
            $table->string('codigo', 12)->unique(); 
            $table->string('nota_cupon')->nullable(); 
            $table->integer('fk_empleado')->unsigned()->nullable();
            $table->foreign('fk_empleado')->references('id')
            ->on('bums_users')
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
        Schema::dropIfExists('coupon');
    }
}