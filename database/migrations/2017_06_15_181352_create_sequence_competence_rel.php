<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSequenceCompetenceRel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequence_competence_rel', function (Blueprint $table) {
            $table->integer('sequence_id')->unsigned();
            $table->integer('competence_id')->unsigned();

            $table->foreign('sequence_id')
                ->references('id')
                ->on('sequences')
                ->onDelete('cascade');

            $table->foreign('competence_id')
                ->references('id')
                ->on('competences')
                ->onDelete('cascade');

            $table->primary(['sequence_id', 'competence_id']);
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
        Schema::dropIfExists('sequence_competence_rel');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
