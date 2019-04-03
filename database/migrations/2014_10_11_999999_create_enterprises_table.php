<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprises', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('name');
            $table->string('email')->unique();
            $table->string('identification_number')->nullable();
            $table->string('password')->nullable();
            $table->boolean('enabled')->default(true);

            $table->integer('parent_enterprise_id')->unsigned()->nullable();
            $table->foreign('parent_enterprise_id')
                ->references('id')
                ->on('enterprises')
                ->onDelete(NULL); 

            $table->integer('identification_type_id')->unsigned()->nullable();
            $table->foreign('identification_type_id')
                ->references('id')
                ->on('identification_types')
                ->onDelete(NULL); 

            $table->rememberToken();
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
        Schema::dropIfExists('enterprises');
    }
}
