<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        //
    }

    //showを削除

    public function edit($id)
    {
        //
    }

    // updateを削除

    public function destroy($id)
    {
        //
    }
}
