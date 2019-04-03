<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('lastName')->nullable();
            $table->date('birth_date')->nullable();
            $table->boolean('gender')->nullable(); //0 Femenino // 1 Masculino
            $table->string('area')->nullable();
            $table->string('sector')->nullable();
            $table->string('email_company')->unique();
            $table->string('work_position')->nullable();
            $table->string('year_experience')->nullable();
            $table->string('academic_degree')->nullable();
            $table->string('academic_field')->nullable();
            $table->string('country_residence')->nullable();
            $table->string('city_residence')->nullable();
            $table->string('country_birth')->nullable();
            $table->string('city_birth')->nullable();
            $table->string('password')->nullable();
            $table->string('email')->nullable();    
            $table->boolean('enabled');

            $table->string('token')->nullable();

            $table->integer('enterprise_id')->nullable()->unsigned();
            $table->foreign('enterprise_id')
                    ->references('id')
                    ->on('enterprises')
                    ->onDelete(null);

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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('users');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
