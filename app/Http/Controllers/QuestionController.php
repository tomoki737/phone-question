<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest as QuestionRequest;
use App\Question;
use App\QuestionImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;;

class QuestionController extends Controller
{
    // public function __constract()
    // {
    //     $this->authorizeResource(Question::class, 'question');
    // }

    public function create()
    {
        return view('questions.create');
    }

    public function store(QuestionRequest $request, Question $question)
    {
        $question->fill($request->all());
        $question->user_id = $request->user()->id;
        $question->save();
        return ['question' => $question];
    }


    public function edit(Question $question)
    {
        return ['question' => $question];
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $question->fill($request->all())->save();
        return $question;
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return $question;
    }

    public function show(Request $request,$question_id)
    {
        $question = Question::where('id', $question_id)->withCount(['answers', 'likes'])->first()->load('answers','user');
        $answers = $question->answers->sortByDesc('best_answer')->load(['comments', 'user', 'comments.user',]);
        $initialIsLikedBy = $question->isLikedBy($request->user());
        return ['question' => $question, 'answers' => $answers, 'initialIsLikedBy' => $initialIsLikedBy];
    }

    public function like(Request $request, Question $question)
    {
        $question->likes()->detach($request->user()->id);
        $question->likes()->attach($request->user()->id);
        return [
            'id' => $question->id,
            'countLikes' => $question->count_likes,
        ];
    }

    public function unlike(Request $request, Question $question)
    {
        $question->likes()->detach($request->user()->id);
        return [
            'id' => $question->id,
            'countLikes' => $question->count_likes,
        ];
    }

    public function best_answer(Question $question, $answer_id)
    {
        $question->best_answer = $answer_id;
        $question->save();
        return back();
    }
    public function search(Request $request)
    {
        $query = Question::query()->orderBy('id', 'asc');
        $content = $request->content;
        if (isset($request->content)) {
            $query->where('body', 'like', "%" . $request->content . "%");
        }
        $questions = $query->get();
        return view('questions.search', ['questions' => $questions, 'content' => $content]);
    }
}
