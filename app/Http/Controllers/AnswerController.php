<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Http\Requests\AnswerRequest as AnswerRequest;
class AnswerController extends Controller
{
    public function store(AnswerRequest $request, $question_id,  Answer $answer)
    {
        $answer->fill($request->all());
        $answer->user_id = $request->user()->id;
        $answer->question_id = $question_id;
        $answer->save();
        return back();
    }
}
