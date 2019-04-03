<?php

use Illuminate\Database\Seeder;

class ProductionSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Alberto',
            'lastname' => 'Ramírez Puicón',
            'email' => env('SUPERADMIN_EMAIL', 'albertoramirezpuicon@gmail.com'),
            'password' => bcrypt(env('SUPERADMIN_PASSWORD', 'secret')),
        ]);

        DB::table('admins_roles_rel')->insert([
        	'admin_id'=>1,
        	'role_id'=>1
        ]);
    }
}
