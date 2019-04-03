<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_results', function (Blueprint $table) {
            $table->integer('int_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('int_res_id')->unsigned();
            
            $table->foreign('int_id')
                ->references('id')
                ->on('enterprises')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('int_res_id')
                ->references('id')
                ->on('interventions')
                ->onDelete('cascade');

            $table->primary(['int_id', 'user_id', 'int_res_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_results');
    }
}
