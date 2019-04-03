<?php

use Illuminate\Database\Seeder;

class IdentificationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('identification_types')->insert([
            ['name'=> 'ruc',
        	'label'=> 'RUC',
        	'desc'=> 'Identificación de la empresa en Perú'],
        	['name'=> 'nif',
            'label'=> 'NIF',
            'desc'=> 'Identificación de la empresa en España']
        ]);
    }
}
