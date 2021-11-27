<div class="border-bottom bg-white p-3">
    <div class="row mb-2">
        <div class="col-sm-11">
            <a href="{{ route('questions.show', ['question' => $question]) }}" class="text-decoration-none h5">{{$question->title}}</a>
        </div>
        @if(Auth::id() === $question->user_id)
        @include('modal', ['questionModal' => true, 'answerModal' => false])
        @endif
        <div class="small col-sm-6 py-0">{{$question->created_at}}</div>
        <div class="small col-sm-6 text-end">{{$question->user->name}}</div>
    </div>
</div>
