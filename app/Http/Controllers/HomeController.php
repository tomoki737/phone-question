<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
class HomeController extends Controller
{
    public function index()
    {
        $questions = Question::whereNotNull('best_answer')->paginate(15);
        return view('home', ['questions' => $questions]);
    }

    public function un_solve()
    {
        $questions = Question::whereNull('best_answer')->paginate(15);
        return view('un_solve', ['questions' => $questions]);
    }
}
