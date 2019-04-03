<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_orders', function (Blueprint $table) {
            $table->increments('id');

            $table->datetime('new_expiration_date')->nullable();      
            $table->integer('uses_added')->nullable();

            $table->integer('license_id')->unsigned();
            $table->foreign('license_id')
                ->references('id')
                ->on('licenses')
                ->onDelete(NULL); 

            $table->string('observations')->nullable;

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
        Schema::dropIfExists('license_orders');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
