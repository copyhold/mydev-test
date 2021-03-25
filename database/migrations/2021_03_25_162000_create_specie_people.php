<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeciePeople extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_specie', function (Blueprint $table) {
          $table->unsignedBigInteger('specie_id');
          $table->foreign('specie_id')
                ->references('id')
                ->on('species')
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
        Schema::dropIfExists('people_specie');
    }
}
