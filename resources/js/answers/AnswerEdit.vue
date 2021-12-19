<template>
  <div class="container" style="max-width: 800px">
    <div class="row">
      <div class="border-bottom mt-4 text-left h3">回答の更新</div>
      <div class="form-group mt-3 mx-auto" style="max-width: 50rem">
        <textarea
          name="body"
          required
          class="form-control"
          rows="7"
          placeholder="回答を入力してください"
          v-model="answer.body"
        ></textarea>
      </div>
      <div class="d-grid col-sm-6 mx-auto mt-3">
        <button class="btn btn-primary" type="button" @click="update">更新</button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
      answer_id :{
          type: Number,
      },
  },
  data() {
      return{
          answer: {},
      };
  },
  methods: {
      async getAnswer() {
        const response = await axios.get(
          "/api/answers/" + this.answer_id + "/edit"
        );
        this.answer = response.data.answer;
      },
      async update() {
        const response = await axios.put(
          "/api/answers/" + this.answer.id, this.answer
        );
        this.$router.push({name: "questions.show", params:{question_id: this.answer.question.id}})
      },
  },
    mounted() {
        this.getAnswer();
    }
};
</script>
