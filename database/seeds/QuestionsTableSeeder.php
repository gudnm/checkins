<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'text' => 'Are you feeling productive?'
        ]);
        DB::table('questions')->insert([
            'text' => 'Are you feeling social?'
        ]);
        DB::table('questions')->insert([
            'text' => 'Are you excited?'
        ]);
    }
}
