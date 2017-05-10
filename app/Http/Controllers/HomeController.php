<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserAnswer;
use App\Question;
use App\Answer;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
     * Show user's history and a link for questionnaire.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        Here's the query used to get all data required for the chart

        SELECT questions.id, questions.text, answers.rating,
        user_answers.created_at FROM answers
        JOIN user_answers ON answers.id = user_answers.answer_id
        JOIN questions ON answers.question_id = questions.id
        WHERE user_answers.user_id = 1;
        +------+-----------------------------+--------+---------------------+
        | id   | text                        | rating | created_at          |
        +------+-----------------------------+--------+---------------------+
        |   11 | Are you feeling productive? |      2 | 2017-05-09 15:56:59 |
        |   11 | Are you feeling productive? |      1 | 2017-05-09 16:02:01 |
        |   11 | Are you feeling productive? |      1 | 2017-05-09 17:03:29 |
        |   12 | Are you feeling social?     |      3 | 2017-05-09 15:56:59 |
        |   12 | Are you feeling social?     |      3 | 2017-05-09 16:02:01 |
        |   12 | Are you feeling social?     |      3 | 2017-05-09 17:03:29 |
        |   13 | Are you excited?            |      2 | 2017-05-09 15:56:59 |
        |   13 | Are you excited?            |      2 | 2017-05-09 16:02:01 |
        |   13 | Are you excited?            |      2 | 2017-05-09 17:03:29 |
        +------+-----------------------------+--------+---------------------+
        9 rows in set (0.00 sec)*/

        $chart_data = DB::table('user_answers')
            ->join('answers', 'answers.id', '=', 'user_answers.answer_id')
            ->join('questions', 'answers.question_id', '=', 'questions.id')
            ->where('user_answers.user_id', Auth::user()->id)
            ->select('questions.text', 'answers.rating',
            'user_answers.created_at')->orderby('created_at')->get();

        /* Let's see what the format of $chart_data is
        print_r($chart_data);

        Illuminate\Support\Collection Object (
            [items:protected] => Array (
                [0] => stdClass Object (
                    [text] => Are you feeling productive?
                    [rating] => 2
                    [created_at] => 2017-05-09 15:56:59
                )
                [1] => stdClass Object ...
                )
                ...
            )
        )*/

        // To chart, we need the data grouped by question
        $rows = [];
        foreach ($chart_data as $row) {
            $rows[$row->text][0][] = $row->rating;
            $rows[$row->text][1][] = $row->created_at;
        }
        /*
        print_r($rows);
        Array (
            [Are you feeling productive?] => Array (
                [0] => Array (
                    [0] => 1
                    [1] => 1
                    [2] => 1
                    ...
                )
                [1] => Array (
                    [0] => 2017-05-09 16:02:01
                    [1] => 2017-05-09 17:03:29
                    [2] => 2017-05-10 16:20:29
                    ...
                )
            )
            [Are you feeling social?] => Array (
                ...
            )
            ...
        )
        */

        $chart = Charts::multi('bar', 'material')
            // Setup the chart settings
            ->title("")
            // A dimension of 0 means it will take 100% of the space
            ->responsive(true) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
            // ->colors(['#2196F3', '#F44336', '#FFC107'])
            // Setup what the values mean
            ->labels(['One', 'Two', 'Three']);

            // Setup the diferent datasets (this is a multi chart)
            foreach ($rows as $question => $data) {
                $chart->dataset($question, $data[0])->labels($data[1]);
            }

        return view('home', compact(['chart']));
    }

    /**
     * This will check for a post request and save the data.
     *
     * @return \Illuminate\Http\Response
     */
     public function storeAnswers(Request $request)
     {
        if (isset($request)) {
            $answers = $request->except('_token');

            foreach ($answers as $question_id => $answer_id) {
                $user_answer = new UserAnswer;
                $user_answer->user_id = Auth::user()->id;
                $user_answer->question_id = $question_id;
                $user_answer->answer_id = $answer_id;
                $user_answer->save();
            }
        }

        return $this->index();
    }

}
