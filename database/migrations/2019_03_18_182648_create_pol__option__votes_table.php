<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolOptionVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll__option__vote', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Fk_Poll_Option')->unsigned();
            $table->timestamps();

            $table->foreign('Fk_Poll_Option')
            ->references('id')
            ->on('poll_options')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll__option__vote');
    }
}
