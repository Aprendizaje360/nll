<?php

use Illuminate\Database\Seeder;

class CompetenceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competence_types')->insert([
            ['name'=> 'transversal',
            'label'=> 'Transversal'],
            ['name'=> 'funcional',
            'label'=> 'Funcional']
        ]);
    }
}
