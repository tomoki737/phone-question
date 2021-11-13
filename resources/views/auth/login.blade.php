@extends('app')

@section('title', 'ログイン')

@section('content')
@include('nav')
<div class="container">
    <div class="row">
        <h1 class="text-center mt-5">ログイン</h1>
        <div class="card mt-3 m-auto" style="width: 30rem;">
            <div class="card-body">
                <div class="mx-auto">
                @include('error_card_list')
                <form method="POST" action="{{ route('login') }}">
                @csrf
                        <div class="form-group my-3">
                            <label for="email">メールアドレス</label>
                            <div class="col-sm-12 mx-auto mt-2">
                                <input type="email" class="form-control" id="email" name ="email" placeholder="メールアドレス" required value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="form-groupm mb-3">
                            <label for="exampleInputPassword1">パスワード</label>
                            <div class="col-sm-12 mx-auto mt-2">
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="パスワード">
                            </div>
                        </div>
                        <input type="hidden" name="remember" id="remember" value="on">
                        <div class="card-body text-center">
                        <button type="submit" class="btn btn-primary  mt-3">ログイン</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
