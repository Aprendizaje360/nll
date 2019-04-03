<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlternativeResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternative_results', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('alternative_id')->unsigned();
            $table->foreign('alternative_id')
                    ->references('id')
                    ->on('alternatives')
                    ->onDelete(null);   

            $table->integer('sequence_result_id')->unsigned();
            $table->foreign('sequence_result_id')
                    ->references('id')
                    ->on('sequence_results')
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
        Schema::dropIfExists('alternative_results');
    }
}
