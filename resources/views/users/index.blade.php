@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
<div class="container mt-4" style="max-width: 800px;">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <p class="p-2">ともきさんのページ</p>
                <div class="col">
                    <div class="d-flex justify-content-center text-center">
                        <i class="far fa-user-circle fa-4x"></i>
                        <p class="p-2">ともき</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @include('users.index_good')
        </div>
        <div class="col-sm-12">
            @foreach($questions as $question)
            @include('card')
            @endforeach
        </div>
    </div>
</div>
@endsection
