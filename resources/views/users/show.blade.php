@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
<div class="container mt-4" style="max-width: 800px;">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <p class="p-2">{{$user->name}}さんのページ</p>
                <div class="col-sm ps-sm-4">
                    <i class="far fa-user-circle fa-4x"></i>
                    <p class="ps-2">{{$user->name}}</p>
                </div>
                @if(Auth::user()->name !== $user->name)
                <div class="col-sm text-sm-end">
                    <follow-button :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())'
                    endpoint="{{ route('users.follow', ['name' => $user->name])}}"></follow-button>
                </div>
                @endif
            </div>
            <div class="col-sm p-2 ps-sm-3">
                <a href="" class="text-decoration-none text-dark me-2">フォロー {{$user->count_followings}}</a>
                <a href="" class="text-decoration-none text-dark">フォロワー  {{$user->count_followings}}</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @include('users.index_good')
        </div>
        <div class="col-sm-12">
        </div>
    </div>
</div>
@endsection
