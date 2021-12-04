@extends('app')
@section('title', '回答更新')
@section('content')
@include('nav')
<div class="container" style="max-width: 800px;">
    <div class="row">
        <div class="border-bottom mt-4 text-left h3">
            回答の更新
        </div>
        <form action="{{route('answers.update',['answer' => $answer])}}" method="post">
            @method('PATCH')
            @include('answers.answer_form', ['hasStore' => false])
                @csrf
            <div class="d-grid col-sm-6 mx-auto mt-3">
                <button class="btn btn-primary" type="submit">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection
