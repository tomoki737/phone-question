<template>
<div>
  <div v-for="(question, index) in questions" :key="index">
      <question-card  :question="question"></question-card>
  </div>
</div>
</template>
<script>
import QuestionCard from '../components/QuestionCard.vue';
export default {
  components: { QuestionCard },
    props:{
        user_name: {
            type:String,
        }
    },
    data(){
      return { questions: {}};
    },
  methods: {
    async getQuestions() {
      const response = await axios.get(
        "/api/users/" + this.user_name + "/questions"
      );
      this.questions = response.data.questions;
    },
  },
  mounted() {
    console.log(this.user_name)
    this.getQuestions();
  },
};
</script>
