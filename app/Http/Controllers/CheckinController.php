<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Question;
use App\Answer;

class CheckinController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the questionnaire.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnaire = array();
        $questions = Question::all();

        foreach ($questions as $question) {
            $answers = Answer::where('question_id', $question->id)->get();
            $qa_set = [
                'question' => $question,
                'answers' => $answers
            ];

            $questionnaire[] = $qa_set;
        }

        return view('checkin', compact(['questionnaire']));
    }
}
