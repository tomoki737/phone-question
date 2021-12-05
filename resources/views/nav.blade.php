<nav class="navbar navbar-expand-sm navbar-light border-bottom py-3 bg-white mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <form class="d-flex align-items-end" action="{{route('questions.search')}}" method="post">
                    @csrf
                    @method('put')
                    <div class="input-group ">
                        <input type="search" class="form-control" placeholder="質問を検索" aria-label="Search" aria-describedby="button-addon2" name="content" value="{{$content ?? old('content')}}">
                        <button class="btn btn-outline-secondary" type="hidden" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                @guest
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('login')}}">ログイン</a>
                </li>
                @endguest
                @guest
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('register')}}">新規登録</a>
                </li>
                @endguest
                @auth
                <li class="nav-item">
                    <div class="d-grid gap-2 d-md-block  mt-sm-2 ms-3">
                        <a class="nav-link  btn btn-primary text-white" aria-current="page" href="{{route('questions.create')}}" role="button">質問する</a>
                    </div>
                </li>
                <li class="nav-item dropdown me-2">
                    <div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <i class="far fa-user-circle fa-2x"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="{{ route('users.show', ['name' => Auth::user()->name]) }}">マイページ</a></li>
                        <li>
                            <hr class="dropdown-divider">
                            <button form="logout-button" class="dropdown-item" type="submit">
                                ログアウト
                            </button>
                            <form id="logout-button" method="POST" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </li>
                        </ul>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
