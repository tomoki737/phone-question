<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm ps-sm-4">
                <i class="far fa-user-circle fa-4x"></i>
                <p class="ps-2">{{$person->name}}</p>
            </div>
            @if(Auth::id() !== $person->id)
            <div class="col-sm text-sm-end">
                <follow-button :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => $person->name])}}"></follow-button>
            </div>
            @endif
        </div>
    </div>
</div>
