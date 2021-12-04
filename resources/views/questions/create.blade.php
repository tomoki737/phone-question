@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
<div class="container" style="max-width: 800px;">
    <div class="row">
        <div class="border-bottom mt-4">
            <h3>質問投稿</h3>
        </div>
        
        <form action="{{route('questions.store')}}" method="post">
            @include('questions.form')
            <div class="d-grid gap-2 col-6 mx-auto mt-2">
                <button class="btn btn-primary" type="hidden">投稿</button>
            </div>
        </form>
    </div>
</div>
@endsection
