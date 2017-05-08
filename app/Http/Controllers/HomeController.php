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
    public function storeAnswers(answers)
    {
        Log::write(answers);
        return view('home');
    }
}
