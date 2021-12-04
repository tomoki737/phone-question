<div class="col-sm-12">
    <ul class="nav nav-pills nav-justified my-2">
        <li class=" nav-item bg-white mx-1" style="border-radius: 12px">
            <a href="{{ route('users.show', ['name' => $user->name]) }}" class="nav-link px-1 pt-1 pb-0 btn btn-sm {{$hasQuestion ? 'active' : ''}}">
                <p>質問</p>
            </a>
        </li>
        <li class="nav-item bg-white mx-1" style="border-radius: 12px">
            <a href="{{ route('users.answers', ['name' => $user->name]) }}" class="nav-link px-1 pt-1 pb-0 btn btn-sm {{$hasAnwer ? 'active' : ''}}">
                <p>回答</p>
            </a>
        </li>
        <li class=" nav-item bg-white mx-1" style="border-radius: 12px">
            <a href="{{ route('users.likes', ['name' => $user->name]) }}" class="nav-link px-1 pt-1 pb-0 btn btn-sm {{$hasLike ? 'active' : ''}}">
                <p>いいね</p>
            </a>
        </li>
    </ul>
</div>
