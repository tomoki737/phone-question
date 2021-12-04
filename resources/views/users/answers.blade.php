@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
<div class="container mt-4" style="max-width: 800px;">
    @include('users.user')
    <div class="row">
        @include('users.tabs',['hasQuestion' => false, 'hasAnwer' => true, 'hasLike' => false])
        <div class="col-sm-12">
            @foreach($answers as $answer)
            <div class="border-bottom bg-white p-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <a href="{{ route('questions.show', ['question' => $answer->question]) }}" class="text-decoration-none">
                            <h5>{{ Str::limit($answer->question->title,80)}}</h5>
                        </a>
                        <div class="border-start border-dark ms-2 ps-2">
                            <small>あなたの回答 : {{ Str::limit($answer->body,100) }}</small>
                        </div>
                    </div>
                    <div class="small col-sm-6 py-0 mt-1">{{$answer->question->created_at}}</div>
                    <div class="small col-sm-6 text-end">{{$answer->question->user->name}}</div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</div>
@endsection
