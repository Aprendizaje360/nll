<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSequencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('background_image_path')->nullable();
            $table->text('description')->nullable();
            $table->text('reflexive_text')->nullable();
            $table->text('transversal_question')->nullable();
            $table->text('functional_question')->nullable();
            $table->string('order')->nullable();
            $table->boolean('enabled')->nullable();

            $table->integer('intervention_id')->unsigned();
            $table->foreign('intervention_id')
                ->references('id')
                ->on('interventions')
                ->onDelete(NULL);

            $table->integer('model_competences_id')->unsigned();
            $table->foreign('model_competences_id')
                ->references('id')
                ->on('model_competences')
                ->onDelete(NULL);

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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('sequences');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
