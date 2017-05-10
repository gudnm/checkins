<?php

use Illuminate\Database\Seeder;
use App\Question;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = Question::all();
        $answers = ['Not at all', 'Not so much', 'Mostly', 'Definitely yes'];

        foreach ($questions as $question) {
            foreach ($answers as $i => $answer) {
                DB::table('answers')->insert([
                  'text' => $answer,
                  'rating' => $i + 1,
                  'question_id' => $question->id
                ]);
            }
        }
    }
}
