<?php

use Illuminate\Database\Seeder;

class EnterpriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('enterprises')->insert([
            'name' => 'empresa',
            'email' => env('ENTERPRISE_EMAIL', 'empresa@g.com'),
            'password' => bcrypt(env('ENTERPRISE_PASSWORD', 'empresa')),
            'identification_number' => '12345678901',
            'identification_type_id' => '1'
        ]);

        DB::table('enteprises_roles_rel')->insert([
            'enterprise_id'=>1,
            'role_id'=>1
        ]);
    }
}