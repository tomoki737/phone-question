@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
<div class="container" style="max-width: 800px;">
    <div class="row">
        <div class="border-bottom mt-4 text-left h3">
            質問投稿
        </div>
        <form action="{{route('questions.store')}}" method="post">
        @include('questions.form')
        <button type="submit">投稿</button>
        </form>
    </div>
</div>
@endsection
