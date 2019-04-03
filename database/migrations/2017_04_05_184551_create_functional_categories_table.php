<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionalCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functional_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('label');
            
            $table->integer('sequence_id')->unsigned();
            $table->foreign('sequence_id')
                  ->references('id')
                  ->on('sequences')
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
        Schema::dropIfExists('functional_categories');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
