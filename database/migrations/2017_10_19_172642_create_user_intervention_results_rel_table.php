<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInterventionResultsRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_int_res_rel', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->integer('int_id')->unsigned();
            $table->integer('results_id')->unsigned();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete(null);

            $table->foreign('int_id')
                ->references('id')
                ->on('interventions')
                ->onDelete(null);

            $table->foreign('results_id')
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
        Schema::dropIfExists('user_int_date_rel');
    }
}
