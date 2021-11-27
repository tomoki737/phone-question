@extends('app')

@section('title', '質問詳細')

@section('content')
@include('nav')
<div class="container">
    <div class="card mx-auto px-3 py-2 mb-3" style="max-width: 50rem;">
        <div class="row">
            <div class="col-sm-1">
                <i class="far fa-user-circle fa-3x"></i>
            </div>
            <div class="col-sm-11">
                <p class="m-0">{{$question->user->name}}</p>
                <small>{{$question->created_at}}</small>
            </div>
            <div class="col-sm-12">
                <h4 class=" mt-2">{{$question->title}}</h4>
            </div>
            <div class="col-sm-12">
                <p class=" mt-2">{{$question->body}}</p>
            </div>
            <div class="col-sm-12">
                <question-like
                :initial-is-liked-by='@json($question->isLikedBy(Auth::user()))'
                :initial-count-likes='@json($question->count_likes)'
                :authorized = '@json(Auth::check())'
                endpoint = "{{ route('questions.like', ['question' => $question]) }}"></question-like>
            </div>
        </div>
    </div>
    <div class="card mx-auto px-3 py-2" style="max-width: 50rem;">
        <h5 class="col-sm-12 mb-3">回答 {{($question->count_answers)}}</h5>
        @foreach($answers as $answer)
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-1">
                    <i class="far fa-user-circle fa-3x"></i>
                </div>
                <div class="col-sm-10">
                    <p class="m-0">{{$answer->user->name}}さん</p>
                    <small>{{$answer->created_at}}</small>
                </div>
                @if(Auth::id() === $answer->user_id)
                @include('modal', ['questionModal' => false, 'answerModal' => true])
                @endif
                <div class="col-sm-12 mt-3">
                    <p class=" mt-2 border-bottom pb-3">{{$answer->body}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <form action="{{ route('answers.store', ['question' => $question->id]) }}" method="POST">
        @method('put')
        @include('answers.form')
        <div class="d-grid col-sm-6 mt-2 mx-auto">
            <button class="btn btn-primary" type="hidden">回答する</button>
        </div>
    </form>
</div>
</div>
@endsection
