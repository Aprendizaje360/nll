<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePercentilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('percentiles', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('r1');
            $table->integer('r2');
            $table->integer('r3');
            $table->integer('r4');
            $table->integer('r5');
            $table->integer('r6');
            $table->integer('r7');
            $table->integer('r8');
            $table->integer('r9');
            $table->integer('r10');
            $table->integer('r11');
            $table->integer('r12');
            $table->integer('r13');
            $table->integer('r14');
            $table->integer('r15');
            $table->integer('r16');

            $table->integer('intervention_id')->unsigned()->nullable();
            $table->foreign('intervention_id')
                ->references('id')
                ->on('interventions')
                ->onDelete(NULL); 

            $table->integer('enterprise_id')->unsigned()->nullable();
            $table->foreign('enterprise_id')
                ->references('id')
                ->on('enterprises')
                ->onDelete(NULL); 

            $table->integer('competence_id')->unsigned()->nullable();
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
        Schema::dropIfExists('percentiles');
    }
}
