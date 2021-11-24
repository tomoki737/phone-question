@extends('app')

@section('title', '質問詳細')

@section('content')
@include('nav')
<div class="container">
    <div class="card mx-auto px-3 py-2 mb-3" style="max-width: 50rem;">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                <h5 class="border-bottom mb-3">質問</h5>
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
                </div>
            </div>
        </div>
    </div>
    @foreach($answers as $key => $answer)
    <div class="card mx-auto px-3 py-2" style="max-width: 50rem;">
        <div class="row">
            @if($key === 1)
            <h5 class="border-bottom mb-3">回答</h5>
            @endif
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-1">
                        <i class="far fa-user-circle fa-3x"></i>
                    </div>
                    <div class="col-sm-11">
                        <p class="m-0">{{$answer->user->name}}</p>
                        <small>{{$answer->created_at}}</small>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <p class=" mt-2">{{$answer->body}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <form action="{{ route('answers.store', ['question_id' => $question->id]) }}" method="POST">
        @method('put')
        @include('questions.answer.form')
        <div class="d-grid col-sm-6 mt-2 mx-auto">
            <button class="btn btn-primary" type="hidden">回答する</button>
        </div>
    </form>
</div>
</div>
@endsection
