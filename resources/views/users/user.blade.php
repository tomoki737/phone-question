<div class="card">
    <div class="card-body">
        <div class="row">
            <p class="p-2">{{$user->name}}さんのページ</p>
            <div class="col-sm ps-sm-4">
                <i class="far fa-user-circle fa-4x  ms-2"></i>
                <p>{{$user->name}}</p>
            </div>
            @if(Auth::id() !== $user->id)
            <div class="col-sm text-sm-end">
                <follow-button :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => $user->name]) }}"></follow-button>
            </div>
            @endif
        </div>
        <div class="col-sm p-2 ps-sm-3">
            <a href="{{ route('users.followings', ['name' => $user->name])}}" class="text-decoration-none text-dark me-2">フォロー {{$user->count_followings}}</a>
            <a href="{{ route('users.followers', ['name' => $user->name])}}" class="text-decoration-none text-dark">フォロワー {{$user->count_followers}}</a>
        </div>
    </div>
</div>
