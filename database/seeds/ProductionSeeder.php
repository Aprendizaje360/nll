<?php

use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(AdminRolesSeeder::class);
        $this->call(ProductionSuperAdminSeeder::class);
        $this->call(IdentificationTypesSeeder::class);
        $this->call(CompetenceTypesSeeder::class);
        $this->call(EnterpriseRolesSeeder::class);
        $this->call(EnterpriseSeeder::class);
    }
}
