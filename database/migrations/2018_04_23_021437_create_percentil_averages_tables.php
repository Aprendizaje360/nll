<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePercentilAveragesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perecentil_averages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('competence_id');
            $table->string('label');
            $table->integer('min');
            $table->integer('max');

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
        Schema::dropIfExists('perecentil_averages');
    }
}
