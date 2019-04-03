<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterpriseRolesRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enteprises_roles_rel', function (Blueprint $table) {
            $table->integer('enterprise_id')->unsigned();
            $table->integer('role_id')->unsigned();
            
            $table->foreign('enterprise_id')
                ->references('id')
                ->on('enterprises')
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on('enterprise_roles')
                ->onDelete('cascade');

            $table->primary(['enterprise_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enteprises_roles_rel');
    }
}
