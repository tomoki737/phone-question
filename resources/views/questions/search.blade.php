@extends('app')

@section('title', '質問詳細')

@section('content')
@include('nav')
<div class="container">
    <div class="row">
        @foreach($questions as $question)
        @include('card')
        @endforeach
    </div>
</div>
@endsection
