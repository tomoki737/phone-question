<template>
<div class="border-bottom bg-white p-3">
    <div class="row mb-2">
        <div class="col-sm-11">
            <!-- <a href="{{ route('questions.show', ['question' => $question]) }}" class="text-decoration-none"> -->
                 <router-link v-bind:to="{name: 'questions.show', params: {question_id: this.question.id}}">
                <h5>{{ this.question.title }}</h5>
                </router-link>
            <!-- </a> -->
            <!-- @foreach($question->answers as $answer)
            @if($question->best_answer === $answer->id) -->
            <!-- <div class="border-start border-dark ms-2 ps-2">
                <small>ベストアンサー : {{ answer.body }}</small>
            </div> -->
            <!-- @endif
            @endforeach -->
        </div>
        <!-- @if(Auth::id() === $question->user_id) -->
        <!-- @include('modal', ['questionModal' => true, 'answerModal' => false, 'commentModal' => 'false'])d -->
        <!-- @endif -->
        <div class="small col-sm-6 py-0 mt-1">{{this.question.created_at}}</div>
        <div class="small col-sm-6 py-0 mt-1">{{this.question.answer}}</div>
        <!-- <div class="small col-sm-6 text-end">{{this.question.user.name}}</div> -->
    </div>
</div>

</template>

<script>
export default {
    props: {
        question:{
            type: [Array, Object],
        }
    },
}
</script>
