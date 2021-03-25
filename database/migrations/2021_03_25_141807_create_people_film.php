<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleFilm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_people', function (Blueprint $table) {
          $table->unsignedBigInteger('film_id');
          $table->foreign('film_id')
                ->references('id')
                ->on('films')
                ->onDelete('cascade');
          $table->unsignedBigInteger('people_id');
          $table->foreign('people_id')
                ->references('id')
                ->on('peoples')
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
        Schema::dropIfExists('film_people');
    }
}
