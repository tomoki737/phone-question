@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
<div class="container" style="max-width: 800px;">
    <div class="row">
        @include('nav-tabs')
        @foreach($questions as $question)
        <span class="border-bottom bg-white">
            <div class="h3">{{$question->title}}</div>
            <div class="h3">{{$question->body}}</div>
            <div class="h3">{{$question->user->name}}</div>
        </span>
        @endforeach
    </div>
</div>
@endsection
