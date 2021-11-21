@extends('app')
@section('title', '質問更新画面')
@section('content')
@include('nav')
<div class="container" style="max-width: 800px;">
    <div class="row">
        <div class="border-bottom mt-4 text-left h3">
            質問の更新
        </div>
        <form action="{{route('questions.update',['question' => $question])}}" method="post">
            @method('PATCH')
            @include('questions.form')
                @csrf
            <div class="d-grid col-sm-6 mx-auto mt-3">
                <button class="btn btn-primary" type="submit">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection
<!-- // -->
