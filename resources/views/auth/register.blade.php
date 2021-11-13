@extends('app')
@section('title', '登録画面')
@section('content')
@include('nav')
<div class="container">
    <div class="row">
        <h1 class="text-center mt-5">ユーザー登録</h1>
        <div class="card mt-3 m-auto" style="width: 30rem;">
            <div class="card-body">
                <div class="mx-auto">
                    @include('error_card_list')
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group my-3">
                            <label for="name">ユーザー名</label>
                            <div class="col-sm-12 mx-auto mt-2">
                                <input type="name" class="form-control" id="name" name="name" placeholder="ユーザー名を入力" required value="{{ old('name') }}">
                            </div>
                            <small>英数字3〜16文字</small>
                        </div>
                        <div class="form-group my-3">
                            <label for="email">メールアドレス</label>
                            <div class="col-sm-12 mx-auto mt-2">
                                <input type="email" class="form-control" id="email" name="email" placeholder="メールアドレスを入力" required value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="form-groupm mb-3">
                            <label for="password">パスワード</label>
                            <div class="col-sm-12 mx-auto mt-2">
                                <input type="password" class="form-control" id="password" name="password" placeholder="パスワードを入力" required>
                            </div>
                        </div>
                        <div class="form-groupm mb-3">
                            <label for="password_confirmation">パスワード（確認）</label>
                            <div class="col-sm-12 mx-auto mt-2">
                                <input type="password" class="form-control" id="password_confirmation" name= "password_confirmation" placeholder="パスワードを確認" required>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <button type="submit" class="btn btn-primary  mt-3">登録</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
