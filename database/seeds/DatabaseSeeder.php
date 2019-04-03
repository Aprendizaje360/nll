<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(AdminRolesSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(IdentificationTypesSeeder::class);
        $this->call(CompetenceTypesSeeder::class);
        $this->call(ModelCompetencesSeeder::class);
        $this->call(EnterpriseRolesSeeder::class);
        $this->call(EnterpriseSeeder::class);
        $this->call(PercentileSeeder::class);
    }
}
