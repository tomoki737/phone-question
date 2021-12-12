<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
class HomeController extends Controller
{
    public function index()
    {
        $questions = Question::whereNotNull('best_answer')->with(['user', 'answers'])->get();
        return ['questions' => $questions];
    }

    public function un_solve()
    {
        $questions = Question::whereNull('best_answer')->with(['user', 'answers'])->get();
        return ['questions' => $questions];
    }
}
