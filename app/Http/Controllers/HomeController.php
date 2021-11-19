<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
class HomeController extends Controller
{
    public function index()
    {
        $questions = Question::all()->sortByDesc('created_at');
        return view('home', ['questions' => $questions]);
    }
}
