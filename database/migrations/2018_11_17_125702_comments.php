<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('id_comentario')->unsigned()->nullable();            
            $table->foreign('id_comentario')->references('id')->on('clients')
            ->onDelete('cascade');
            $table->string('nombre',50)->default('Anonimo');
            $table->string('texto', 300);    
            $table->date('fecha_comentado');
            $table->binary('aprobado')->nullable()->default(NULL);
            $table->date('fecha_aprobado')->nullable();
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
        Schema::dropIfExists('comment');

    }
}
