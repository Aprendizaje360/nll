<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetenceLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competence_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->text('technical_description');
            $table->text('amicable_description');
            $table->text('report_description');
            $table->integer('level');
            $table->boolean('enabled')->nullable();

            $table->integer('competence_id')->unsigned();
            $table->foreign('competence_id')
                ->references('id')
                ->on('competences')
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
        Schema::dropIfExists('competence_levels');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
