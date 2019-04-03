<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSequenceVideoRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequence_video_rel', function (Blueprint $table) {
            $table->integer('sequence_id')->unsigned();
            $table->integer('video_id')->unsigned();

            $table->boolean('used_in_transversal')->default(false);

            $table->foreign('sequence_id')
                ->references('id')
                ->on('sequences')
                ->onDelete('cascade');

            $table->foreign('video_id')
                ->references('id')
                ->on('videos')
                ->onDelete('cascade');

            $table->primary(['sequence_id', 'video_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sequence_video_rel');
    }
}
