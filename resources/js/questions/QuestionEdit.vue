<template>
  <div class="container" style="max-width: 800px">
    <div class="row">
      <div class="border-bottom mt-4 text-left h3">質問</div>
      <div class="form-group mt-3 mx-auto" style="max-width: 50rem">
        <textarea
          name="body"
          required
          class="form-control"
          rows="7"
          placeholder="回答を入力してください"
          v-model="question.body"
        ></textarea>
      </div>
      <div class="d-grid col-sm-6 mx-auto mt-3">
        <button class="btn btn-primary" type="button" @click="update">
          更新
        </button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    question_id: {
      type: Number,
    },
  },
  data() {
    return {
      question: {},
    };
  },
  methods: {
    async getQuestion() {
      const response = await axios.get(
        "/api/questions/" + this.question_id + "/edit"
      );
      this.question = response.data.question;
    },
    async update() {
      const response = await axios.put(
        "/api/questions/" + this.question.id,
        this.question
      );
      this.$router.push({
        name: "questions.show",
        params: { question_id: this.question.id },
      });
    },
  },
  mounted() {
    this.getQuestion();
    console.log(this.question)
  },
};
</script>
