<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompetenceResultLabelPredominantColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competence_results', function (Blueprint $table) {
            $table->integer('label')->nullable();
            $table->integer('predominant')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competence_results', function (Blueprint $table) {
            $table->dropColumn('label');
            $table->dropColumn('predominant');
        });
    }
}
