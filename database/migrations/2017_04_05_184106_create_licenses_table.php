<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('licenses', function (Blueprint $table) {
            $table->increments('id');
            //$table->datetime('enable_date');
            $table->datetime('expiration_date'); 
            $table->integer('currently_enrolled')->default(0);     
            $table->integer('uses');
            $table->integer('total_uses');

            $table->integer('enterprise_id')->unsigned();
            $table->foreign('enterprise_id')
                ->references('id')
                ->on('enterprises')
                ->onDelete(NULL); 

            $table->integer('intervention_id')->unsigned();
            $table->foreign('intervention_id')
                ->references('id')
                ->on('interventions')
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
        Schema::dropIfExists('licenses');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
