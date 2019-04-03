<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlternativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternatives', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->boolean('enabled')->nullable();

            $table->integer('level')->nullable();

            $table->integer('sequence_id')->unsigned();
            $table->foreign('sequence_id')
                  ->references('id')
                  ->on('sequences')
                  ->onDelete(NULL);

            $table->integer('competence_level_id')->unsigned();
            $table->foreign('competence_level_id')
                  ->references('id')
                  ->on('competence_levels')
                  ->onDelete(NULL);

            $table->integer('functional_category_id')->unsigned()->nullable();
            $table->foreign('functional_category_id')
                  ->references('id')
                  ->on('functional_categories')
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
        Schema::dropIfExists('alternatives');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
