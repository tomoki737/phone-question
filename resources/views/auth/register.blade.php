@extends('app')
@section('title', '登録画面')
@section('content')
@include('nav')
<div class="container">
    <div class="row">
        <h1 class="text-center mt-5">ユーザー登録</h1>
        <div class="card mt-3 m-auto" style="width: 35rem;">
            <div class="card-body">
                <div class="mx-auto">
                    @include('error_card_list')
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="card-body">
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
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="パスワードを確認" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div class="d-grid gap-2 col-12 mx-auto">
                                <button class="btn btn-primary" type="hidden">登録</button>
                            </div>
                        </div>
                    </form>
                    <div class="card-body pt-0 text-center">
                        <p class="card-title border-top pt-4">
                            <span>アカウントを</span>
                            <span>お持ちの方はこちら</span>
                        </p>
                        <form action="{{ route('login') }}" method="get">
                            <div class="d-grid gap-2 col-12 mx-auto">
                                <button type="hidden" class="btn btn-outline-success mt-2">ログイン</button>
                            </div>
                        </form>
                    </div>

                    <div class="card-body pt-0 text-center">
                        <p class="card-title border-top pt-4">
                            <span>ユーザー登録せずに</span>
                            <span>機能を試したい方はこちら</span>
                        </p>
                        <form action="{{ route('login.guest') }}" method="get">
                            <div class="d-grid gap-2 col-12 mx-auto">
                                <button type="hidden" class="btn btn-outline-danger mt-2">ゲストユーザーログイン</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
