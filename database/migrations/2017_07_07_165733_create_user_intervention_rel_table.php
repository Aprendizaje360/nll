<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInterventionRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_int_rel', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('int_id')->unsigned();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('int_id')
                ->references('id')
                ->on('interventions')
                ->onDelete('cascade');

            $table->timestamps();

            $table->primary(['user_id', 'int_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_int_rel');
    }
}
