<?php

use Illuminate\Database\Seeder;

class PercentileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('percentiles')->insert([
            ['r1' => 10,
             'r2' => 15,
             'r3' => 30,
             'r4' => 25,
             'r5' => 45,
             'r6' => 20,
             'r7' => 15,
             'r8' => 20,
             'r9' => 18,
             'r10' => 30,
             'r11' => 40,
             'r12' => 23,
             'r13' => 33,
             'r14' => 13,
             'r15' => 12,
             'r16' => 27,
             'intervention_id' => 1,
             'enterprise_id' => 1,
             'competence_id' => 1]
        ]);
    }
}
