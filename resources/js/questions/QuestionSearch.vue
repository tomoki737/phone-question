<template>
  <div class="container" style="max-width: 800px">
    <div class="row">
      <div class="col-sm-12">
        <div v-if="!questions.length">
          <h5>{{ content }} に一致するQ&Aは見つかりませんでした。</h5>
          <div class="col-sm-12">
            <div class="card mt-3">
              <div class="card-body">
                <span>検索しても答えが見つからない方は…</span>
                <router-link v-bind:to="{ name: 'questions.create' }">
                  <div class="d-grid gap-2 col-sm-6 mx-auto mt-3">
                    <button class="btn btn-primary" type="hidden">
                      質問する
                    </button>
                  </div>
                </router-link>
              </div>
            </div>
          </div>
        </div>
        <div v-if="questions.length">
          <div v-for="(question, index) in questions" :key="index">
            <question-card :question="question"></question-card>
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
    content: {
      type: String,
    },
  },
  data() {
    return {
      questions: {},
    };
  },
  methods: {
    async getQuestions() {
      console.log(this.content);
      const response = await axios.get("/api/search/" + this.content);
      this.questions = response.data.questions;
    },
  },
  watch: {
      content:function() {
          this.getQuestions();
      }
  },
  mounted() {
    console.log(this.questions);
    this.getQuestions();
  },
};
</script>
