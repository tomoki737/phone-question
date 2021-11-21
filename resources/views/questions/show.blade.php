@extends('app')

@section('title', '質問詳細')

@section('content')
@include('nav')
<div class="container">
    <div class="card mx-auto px-3 py-2 mb-4" style="max-width: 50rem;">
        <div class="row">
            <div class="col-sm-12">
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
                </div>
            </div>
        </div>
    </div>
    <div class="card mx-auto px-3 py-2" style="max-width: 50rem;">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-1">
                        <i class="far fa-user-circle fa-3x"></i>
                    </div>
                    <div class="col-sm-11">
                        <p class="m-0">{{$question->user->name}}</p>
                        <small>{{$question->created_at}}</small>
                    </div>
                    <div class="col-sm-12">
                        <p class=" mt-2">こうしたらいいですよ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
