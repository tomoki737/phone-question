<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class UserController extends Controller
{
    public function index()
    {
        $questions = Question::all()->sortByDesc('created_at');
        return view('users.index', ['questions' => $questions]);
    }
}
