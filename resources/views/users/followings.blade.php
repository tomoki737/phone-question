@extends('app')

@section('title', 'フォロワー一覧')

@section('content')
@include('nav')
<div class="container mt-4" style="max-width: 800px;">
    @include('users.user')
    <div class="row">
        @include('users.tabs',['hasQuestion' => false, 'hasAnwer' => false, 'hasLike' => false])
        <div class="col-sm-12">
            @foreach($followings as $person)
            @include('users.person')
            @endforeach
        </div>
    </div>
</div>
@endsection
