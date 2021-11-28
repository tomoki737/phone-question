<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Http\Requests\AnswerRequest as AnswerRequest;
class AnswerController extends Controller
{
    public function store(AnswerRequest $request, $question,  Answer $answer)
    {
        $answer->fill($request->all());
        $answer->user_id = $request->user()->id;
        $answer->question_id = $question;
        $answer->save();
        return back();
    }
    public function update(AnswerRequest $request, Answer $answer)
    {
        $answer->fill($request->all());
        $answer->save();
        return redirect(route('questions.show', ['question' => $answer->question_id]));
    }
    public function edit(Answer $answer)
    {
        return view('answers.edit', ['answer' => $answer]);
    }

    public function destroy(Answer $answer)
    {
        $answer->delete();
        return back();
    }

    public function comment(CommentRequest $request, Comment $comment, $answer_id)
    {
        $comment->fill($request->all());
        $comment->user_id = $request->user()->id;
        $comment->answer_id = $answer_id;
        $comment->save();
    }
}
