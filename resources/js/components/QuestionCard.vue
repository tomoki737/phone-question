<template>
<div class="border-bottom bg-white p-3">
    <div class="row mb-2">
        <div class="col-sm-11">
                 <router-link v-bind:to="{name: 'questions.show', params: {question_id: question.id}}" class="text-decoration-none">
                <h5>{{ question.title }}</h5>
                </router-link>
                <div v-for=" (answer, index) in question.answers" :key="index">
            <div class="border-start border-dark ms-2 ps-2" v-if="question.best_answer === answer.id">
                <small>ベストアンサー : {{ answer.body }}</small>
            </div>
            </div>
        </div>

        <div class="small col-sm-6 py-0 mt-1">{{question.created_at}}</div>
        <div class="small col-sm-6 py-0 mt-1 text-right">{{question.user.name}}</div>
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
