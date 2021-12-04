<div class="border-bottom bg-white p-3">
    <div class="row mb-2">
        <div class="col-sm-11">
            <a href="{{ route('questions.show', ['question' => $question]) }}" class="text-decoration-none">
                <h5>{{ Str::limit($question->title,80)}}</h5>
            </a>
            @foreach($question->answers as $answer)
            @if($question->best_answer === $answer->id)
            <div class="border-start border-dark ms-2 ps-2">
                <small>ベストアンサー : {{ Str::limit($answer->body,80) }}</small>
            </div>
            @endif
            @endforeach
        </div>
        @if(Auth::id() === $question->user_id)
        @include('modal', ['questionModal' => true, 'answerModal' => false, 'commentModal' => 'false'])
        @endif
        <div class="small col-sm-6 py-0 mt-1">{{$question->created_at}}</div>
        <div class="small col-sm-6 text-end">{{$question->user->name}}</div>
    </div>
</div>
