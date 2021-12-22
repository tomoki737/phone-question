<template>
  <div>
    <div v-for="(question, index) in questions" :key="index">
      <question-card v-bind:question="question"></question-card>
    </div>
  </div>
</template>
<script>
import QuestionCard from "./QuestionCard";

export default {
  components: {
    QuestionCard,
  },
  data() {
    return {
      questions: {},
    };
  },
  methods: {
    async getQuestions() {
      const response = await axios.get("/api/un_solve");
      this.questions = response.data.questions;
    },
  },
  mounted() {
    this.getQuestions();
  },
};
</script>
