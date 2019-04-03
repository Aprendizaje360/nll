<?php

use Illuminate\Database\Seeder;

class AdminRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_roles')->insert([
            ['name'=> 'superadmin',
            'label'=> 'SuperAdmin',
            'desc'=> 'Admin client'],
            ['name'=> 'superclerk',
            'label'=> 'SuperClerk',
            'desc'=> 'Admin Clerk']
        ]);
    }
}
