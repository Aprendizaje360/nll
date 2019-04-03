<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterpriseInterventionRel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ent_int_rel', function (Blueprint $table) {
            $table->integer('intervention_id')->unsigned();
            $table->integer('enterprise_id')->unsigned();

            $table->boolean('has_permission')->default(false);

            $table->foreign('intervention_id')
                ->references('id')
                ->on('interventions')
                ->onDelete('cascade');

            $table->foreign('enterprise_id')
                ->references('id')
                ->on('enterprises')
                ->onDelete('cascade');

            $table->primary(['intervention_id', 'enterprise_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ent_int_rel');
    }
}
