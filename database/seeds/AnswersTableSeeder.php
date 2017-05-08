<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('answers')->insert([
              'text' => 'Dummy asnwer ' . $i,
              'rating' => $i,
              'question_id' => 1
            ]);
        }
    }
}
