<template>
  <div>
    <div v-for="(answer, index) in answers" :key="index">
      <div class="border-bottom bg-white p-3">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="text-decoration-none">
              <h5>{{ answer.question.title }}</h5>
            </a>
            <div class="border-start border-dark ms-2 ps-2">
              <small>あなたの回答 : {{ answer.body }}</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import QuestionCard from "../components/QuestionCard.vue";
export default {
  components: { QuestionCard },
  props: {
    user_name: {
      type: String,
    },
  },
  data() {
    return { answers: {} };
  },
  methods: {
    async getAnswers() {
      const response = await axios.get(
        "/api/users/" + this.user_name + "/answers"
      ).catch((error) => {
          console.error(error);
      })
      this.answers = response.data.answers;
    },
  },
  mounted() {
    this.getAnswers();
  },
};
</script>
