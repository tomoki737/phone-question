<nav class="navbar navbar-expand-sm navbar-light border-bottom py-3 bg-white mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
                </li>
                <li class="nav-item">
                    </li>
                    @endauth
                </ul>
                <a class="nav-link  btn btn-primary me-2" aria-current="page" href="{{route('questions.create')}}" role="button" style="max-width: 150px;">質問する</a>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
