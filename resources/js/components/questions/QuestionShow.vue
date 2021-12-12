<template>
<div class="container">
    <div class="card mx-auto px-3 py-2 mb-3" style="max-width: 50rem;">
        <div class="row">
            <div class="col-sm-1">
                <!-- <a href="{{route('users.show', ['name' => this.question.user.name])}}"><i class="far fa-user-circle fa-3x text-dark"></i></a></p> -->
            </div>
            <div class="col-sm-11">
                <!-- <a href="{{route('users.show', ['name' => this.question.user.name])}}" class=" text-decoration-none"> -->
                    <!-- <p class="m-0 text-dark">{{this.question.user.name}}</p> -->
                <!-- </a> -->
                <small>{{this.question.created_at}}</small>
            </div>
            <div class="col-sm-12">
                <h4 class=" mt-2">{{this.question.title}}</h4>
            </div>
            <div class="col-sm-12">
                <p class=" mt-2">{{this.question.body}}</p>
            </div>
            <!-- <div class="col-sm-12">
                <this.question-like :initial-is-liked-by='@json(this.question.isLikedBy(Auth::user()))' :initial-count-likes='@json(this.question.count_likes)' :authorized='@json(Auth::check())' endpoint="{{ route('questions.like', ['this.question' => this.question]) }}"></this.question-like>
            </div> -->
        </div>
    </div>
    <div class="row">
    </div>
    <!-- @foreach(answers as answer) -->
    <div class="card mx-auto px-3 py-2 mb-2" style="max-width: 50rem;">
        <div class="row">
            <!-- @if(loop.first) -->
            <h5 class="col-sm-12 mb-3 border-bottom pb-2">回答 {{(this.question.count_answers)}} 件</h5>
            <!-- @endif
            @if(answer.id === this.question.best_answer) -->
            <h5 class="col-sm-12 mb-3">ベストアンサー</h5>
            <!-- @endif -->
            <div class="col-sm-1">
                <!-- <a href="{{route('users.show', ['name' => answer.user.name])}}"><i class="far fa-user-circle fa-3x text-dark"></i></a></p> -->
            </div>
            <div class="col-sm-10">
                <!-- <a href="{{route('users.show', ['name' => answer.user.name])}}" class=" text-decoration-none"> -->
                    <!-- <p class="m-0 text-dark">{{answer.user.name}}</p> -->
                <!-- </a> -->
                <!-- <small>{{answer.created_at}}</small> -->
            </div>
            <!-- @if(Auth::id() === answer.user_id)
            @include('modal', ['questionModal' => false, 'answerModal' => true, 'commentModal' => 'false'])
            @endif -->
            <!-- <div class="col-sm-12 mt-3">
                <p class=" mt-2 pb-2">{{answer.body}}</p>
            </div> -->
            <!-- @if(!this.question.best_answer && Auth::user().id === this.question.user.id) -->
            <div class="col-sm-12">
                <!-- <form action="{{ route('questions.best_answer', ['this.question' => this.question,'answer' => answer]) }}" method="post">
                    @csrf
                    @method('put') -->
                    <button class="btn btn-danger mb-3" type="hidden">ベストアンサーに選ぶ</button>
                <!-- </form> -->
            </div>
            <!-- @endif
            @foreach(answer.comments as comment) -->
            <div class="col-sm-1">
                <i class="far fa-user-circle fa-2x pe-0"></i>
            </div>
            <div class="col-sm-10 p-0">
                <!-- <p class="my-auto">{{comment.user.name}}</p> -->
            </div>
            <!-- @if(Auth::id() === comment.user_id)
            @include('modal', ['questionModal' => false, 'answerModal' => false, 'commentModal' => 'true'])
            @endif -->
            <!-- <div class="col-sm-12 mt-2">
                <div class="border-start ms-3 ps-2 border-dark">
                    <small>{{comment.created_at}}</small>
                    <p>{{comment.body}}</p>
                </div>
            </div> -->
            <!-- @endforeach
            @auth -->
            <!-- <form action="{{ route('answers.comment', ['answer' => answer.id]) }}" method="POST">
                @method('put') -->
                <div class="col-sm-12">
                    <!-- @include('answers.comment_form') -->
                </div>
                <div class="d-grid col-sm-3 mt-2 float-end">
                    <button class="btn btn-primary mb-3" type="hidden">コメントを書く</button>
                </div>
            <!-- </form> -->
            <!-- @endauth -->
        </div>
    </div>
    <div class="d-grid col-sm-6 mt-2 mx-auto">
        <button class="btn btn-primary" type="hidden">回答する</button>
    </div>
<!-- </div>
@endforeach
@auth
 <form action="{{ route('answers.store', ['this.question' => this.question.id]) }}" method="POST">
    @method('put')
    @include('answers.answer_form',['hasStore' => true]) -.
</form> -->
</div>
</template>
<script>
export default {
    props: {
        question: {
            type: Object,
        },
    }
}
</script>
