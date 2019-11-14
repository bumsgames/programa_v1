<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_creator')->unsigned();            
            $table->foreign('id_creator')->references('id')
            ->on('bums_users')
            ->onDelete('restrict');
            $table->string('name', 200)->default('Sin nombre');
            $table->string('description', 200)->default('** SIN DESCRIPCION **')->nullable();  
            $table->integer('category')->unsigned()->default(1);            
            $table->foreign('category')->references('id')
            ->on('categories')
            ->onDelete('restrict');
            $table->float('price_in_dolar')->default(0);
            $table->float('offer_price')->default(0);
            $table->float('peso')->default(0);
            $table->integer('quantity')->default(1)->unsigned();
            $table->integer('oferta')->default(0);
        
            $table->string('email', 200)->default('Sin correo electronico')->nullable();
            $table->string('password', 100)->default('No vender sin colocar la clave')->nullable();
            $table->string('nickname', 100)->default('No vender sin colocar nickname')->nullable();
            $table->timestamp('ultimo_agregado', 100)->nullable();
            $table->timestamp('fecha_agotado', 100)->nullable();
            $table->date('reset_button', 100)->nullable();
            $table->string('note', 300)->nullable();
            $table->string('image', 200)->default('nada.jpg');
            $table->string('fondo', 200)->default('fondo_nada.jpg');
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
        Schema::dropIfExists('articles');
    }
}
