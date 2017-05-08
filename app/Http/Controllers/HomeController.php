<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        foreach ($request as $answer) {
            $user_answer = new UserAnswer;
            $user_answer->user = $answer->user;
            $user_answer->question = $answer->question;
            $user_answer->answer = $answer->answer;
            $user_answer->save();
        }
        return view('home');
    }
}
