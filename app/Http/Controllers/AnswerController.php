<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Comment;
use App\Http\Requests\AnswerRequest as AnswerRequest;
use App\Http\Requests\CommentRequest as CommentRequest;
class AnswerController extends Controller
{
    public function __constract()
    {
        $this->authorizeResource(Answer::class, 'answer');
        $this->authorizeResource(Comment::class, 'comment');
    }

    public function store(AnswerRequest $request, $question,  Answer $answer)
    {
        $answer->fill($request->all());
        $answer->user_id = $request->user()->id;
        $answer->question_id = $question;
        $answer->save();
    }

    public function update(AnswerRequest $request, Answer $answer)
    {
        $answer->fill($request->all());
        $answer->save();
    }
    public function edit(Answer $answer)
    {
        $answer->load('question');
        return ['answer' => $answer];
    }

    public function destroy(Answer $answer)
    {
        $answer->delete();
    }

    public function comment(CommentRequest $request, Comment $comment, $answer_id)
    {
        $comment->fill($request->all());
        $comment->user_id = $request->user()->id;
        $comment->answer_id = $answer_id;
        $comment->save();
    }
    public function uncomment(Comment $comment)
    {
        $comment->delete();
    }
}
