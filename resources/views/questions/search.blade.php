@extends('app')

@section('title', '検索画面')

@section('content')
@include('nav')
<div class="container" style="max-width: 800px;">
    <div class="row">
        @if($questions->isEmpty())
        <div class="col-sm-12">
            <h5>{{$content}} に一致するQ&Aは見つかりませんでした。</h5>
        </div>
        <div class="col-sm-12">
            <div class="card mt-3">
                <div class="card-body">
                    <span>検索しても答えが見つからない方は…</span>
                    <form action="{{route('questions.create')}}" method="get">
                        <div class="d-grid gap-2 col-sm-6 mx-auto mt-3">
                            <button class="btn btn-primary" type="hidden">質問する</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            @foreach($questions as $question)
            @include('card')
            @endforeach
        </div>
    </div>
    @endsection
