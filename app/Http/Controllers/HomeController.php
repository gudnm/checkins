<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserAnswer;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Store answers and show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAnswers(Request $request)
    {
        $answers = $request->except('_token');

        foreach ($answers as $question_id => $answer_id) {
            $user_answer = new UserAnswer;
            $user_answer->user_id = Auth::user()->id;
            $user_answer->question_id = $question_id;
            $user_answer->answer_id = $answer_id;
            $user_answer->save();
        }

        return view('home');
    }
}
