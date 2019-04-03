<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSequenceResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequence_results', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('order')->nullable();

            $table->integer('intervention_result_id')->unsigned();
            $table->foreign('intervention_result_id')
                    ->references('id')
                    ->on('intervention_results')
                    ->onDelete(null);            

            $table->integer('sequence_id')->unsigned();
            $table->foreign('sequence_id')
                    ->references('id')
                    ->on('sequences')
                    ->onDelete(null);   

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
        Schema::dropIfExists('sequence_results');
    }
}
