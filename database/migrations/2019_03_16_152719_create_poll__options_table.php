<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll__options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('contador')->default(0);
            $table->integer('Fk_Poll')->unsigned();
            $table->string('color');

            $table->foreign('Fk_Poll')
            ->references('id')
            ->on('polls')
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
        Schema::dropIfExists('poll__options');
    }
}
