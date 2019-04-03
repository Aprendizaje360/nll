<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetenceResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competence_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('score');

            $table->integer('competence_id')->unsigned();
            $table->foreign('competence_id')
                    ->references('id')
                    ->on('competences')
                    ->onDelete(null);

            $table->integer('competence_level_id')->unsigned();
            $table->foreign('competence_level_id')
                    ->references('id')
                    ->on('competence_levels')
                    ->onDelete(null);

            $table->integer('intervention_result_id')->unsigned();
            $table->foreign('intervention_result_id')
                    ->references('id')
                    ->on('intervention_results')
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
        Schema::dropIfExists('competence_results');
    }
}
