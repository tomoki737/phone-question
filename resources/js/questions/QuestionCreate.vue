<template>
  <div>
    <div class="container" style="max-width: 800px">
      <div class="row">
        <div class="border-bottom mt-4">
          <h3>質問投稿</h3>
        </div>
        <form v-on:submit.prevent="submit">
          <div class="md-form mt-2">
            <label>タイトル</label>
            <input
              type="text"
              id="title"
              class="form-control"
              placeholder="タイトルを入力してください"
              required
              v-model="question.title"
            />
          </div>
          <div class="form-group mt-3">
            <label>本文</label>
            <textarea
              id="body"
              required
              class="form-control"
              rows="10"
              placeholder="本文を入力してください"
              v-model="question.body"
            ></textarea>
          </div>
          <div class="d-grid gap-2 col-6 mx-auto mt-3">
            <button class="btn btn-primary" type="submit">投稿</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      question: {},
    };
  },
  methods: {
    submit() {
      axios
        .post("/api/questions", this.question)
        .then((res) => {
          this.$router.push({ name: "home" });
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>
