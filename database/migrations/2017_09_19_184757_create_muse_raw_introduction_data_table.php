<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuseRawIntroductionDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muse_raw_introduction_data', function (Blueprint $table) {
            $table->increments('id');

            $table->float('alpha_absolute');
            $table->float('beta_absolute');
            $table->float('delta_absolute');
            $table->float('theta_absolute');
            $table->float('gamma_absolute');

            $table->datetime('timestamp');

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
        Schema::dropIfExists('muse_raw_introductions');
    }
}
