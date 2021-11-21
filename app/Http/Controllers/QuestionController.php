<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest as QuestionRequest;
use Illuminate\Http\Request;
use App\Models\Question;
class QuestionController extends Controller
{
    public function __constract(){
        $this->authorizeResource(Question::class, 'question');
    }
    public function create()
    {
        return view('questions.create');
    }

    public function store(QuestionRequest $request, Question $question)
    {
        $question->fill($request->all());
        $question->user_id = $request->user()->id;
        $question->save();
        return redirect(route('home'));
    }


    public function edit(Question $question)
    {
        return view('questions.edit', ['question' => $question]);
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $question->fill($request->all())->save();
        return redirect(route('home'));
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect(route('home'));
    }
    public function show(Question $question)
    {
        return view('questions.show', ['question' => $question]);
    }
}
