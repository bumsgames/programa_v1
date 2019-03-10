<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homeworks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('de_usuario')->unsigned();
            $table->foreign('de_usuario')->references('id')->on('bums_users')
            ->onDelete('restrict');
            $table->integer('para_usuario')->unsigned();
            $table->foreign('para_usuario')->references('id')->on('bums_users')
            ->onDelete('restrict');
            $table->string('mensaje', 1000);
            $table->integer('status')->unsigned();
            $table->foreign('status')->references('id')->on('statuses')
            ->onDelete('restrict');
            $table->timestamps();
        });
    }
    
   
    public function down()
    {
        Schema::dropIfExists('homeworks');
    }

}