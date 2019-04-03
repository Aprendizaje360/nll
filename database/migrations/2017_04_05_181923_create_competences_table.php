<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competences', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('label');
            $table->text('description');

            $table->timestamps();

            $table->integer('model_competences_id')->unsigned();
            $table->foreign('model_competences_id')
                ->references('id')
                ->on('model_competences')
                ->onDelete(NULL);

            $table->integer('competence_type_id')->unsigned();
            $table->foreign('competence_type_id')
                ->references('id')
                ->on('competence_types')
                ->onDelete(NULL);

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
        Schema::dropIfExists('competences');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
