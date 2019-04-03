<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->boolean('enabled')->nullable();
            $table->text('welcome_text');
            $table->text('introduction');
            $table->text('case_introduction');
            $table->text('final_text');
            $table->string('support_mail');

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
        Schema::dropIfExists('interventions');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
