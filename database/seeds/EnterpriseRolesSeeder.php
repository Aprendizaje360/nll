<?php

use Illuminate\Database\Seeder;

class EnterpriseRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('enterprise_roles')->insert([
            ['name'=> 'enterprise',
            'label'=> 'Enterprise',
            'desc'=> 'Admin de empresa'],
            ['name'=> 'clerk',
            'label'=> 'Clerk',
            'desc'=> 'Clerk de Empresa']
        ]);
    }
}
