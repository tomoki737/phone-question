<template>
  <div>
    <div class="container">
      <div class="card mx-auto px-3 py-2 mb-3" style="max-width: 50rem">
        <div class="row">
          <div class="col-sm-1">
            <i class="far fa-user-circle fa-3x text-dark"></i>
          </div>
          <div class="col-sm-10">
            <p class="m-0 text-dark">{{ question.user.name }}</p>
            <small>{{ question.created_at }}</small>
          </div>
          <div class="col-sm-1">
            <div
              class="dropdown d-flex flex-row-reverse"
              v-if="question.user.id === user_id"
            >
              <i
                class="fas fa-ellipsis-v"
                id="dropdownMenuButton"
                style="cursor: pointer"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              ></i>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <router-link
                  v-bind:to="{
                    name: 'questions.edit',
                    params: { question_id: question.id },
                  }"
                >
                  <li class="dropdown-item">編集</li>
                </router-link>
                <li
                  class="dropdown-item"
                  style="cursor: pointer"
                  @click="questionDelete(question.id)"
                >
                  削除
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-12">
            <h4 class="mt-2">{{ question.title }}</h4>
          </div>
          <div class="col-sm-12">
            <p class="mt-2">{{ question.body }}</p>
          </div>
          <div class="col-sm-12">
            <question-like
              :initial-is-liked-by="initialIsLikedBy"
              :initial-count-likes="question.likes_count"
              :authorized="isLogin"
              :question_id="question.id"
            ></question-like>
          </div>
        </div>
      </div>
      <div v-for="(answer, index) in answers" :key="index">
        <div class="card mx-auto px-3 py-2 mb-2" style="max-width: 50rem">
          <div class="row">
            <h5 class="col-sm-12 mb-3 border-bottom pb-2" v-if="index === 0">
              回答 {{ question.answers_count }} 件
            </h5>
            <h5
              class="col-sm-12 mb-3"
              v-if="answer.id === question.best_answer"
            >
              ベストアンサー
            </h5>
            <div class="col-sm-1">
              <i class="far fa-user-circle fa-3x text-dark pe-2"></i>
            </div>
            <div class="col-sm-10">
              <router-link
                v-bind:to="{
                  name: 'users.show',
                  params: { user_name: answer.user.name },
                }"
              >
                <p class="m-0 text-dark">{{ answer.user.name }}</p>
              </router-link>
              <small>{{ answer.created_at }}</small>
            </div>
            <div class="col-sm-1">
              <div
                class="dropdown d-flex flex-row-reverse"
                style="cursor: pointer"
                v-if="answer.user_id === user_id"
              >
                <i
                  class="fas fa-ellipsis-v"
                  id="dropdownMenuButton"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  style="cursor: pointer"
                ></i>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <router-link
                    v-bind:to="{
                      name: 'answers.edit',
                      params: { answer_id: answer.id },
                    }"
                  >
                    <li class="dropdown-item">編集</li>
                  </router-link>
                  <li
                    class="dropdown-item"
                    style="cursor: pointer"
                    @click="answerDelete(answer.id)"
                  >
                    削除
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-sm-12 mt-3">
              <p class="mt-2 pb-2">{{ answer.body }}</p>
            </div>
            <div class="col-sm-12">
              <button
                class="btn btn-danger mb-3"
                v-if="question.user.id === user_id && !question.best_answer"
                type="button"
                @click="bestAnswer(question.id, answer.id)"
              >
                ベストアンサーに選ぶ
              </button>
            </div>
            <div
              v-for="(comment, index) in answer.comments"
              :key="index"
              class="row"
            >
              <div class="col-sm-11">
                <i class="far fa-user-circle fa-2x"></i>
                <span class="my-auto">{{ comment.user.name }}</span>
              </div>
              <div
                class="dropdown d-flex flex-row-reverse col-sm-1"
                v-if="comment.user.id === user_id"
              >
                <i
                  class="fas fa-ellipsis-v"
                  id="dropdownMenuButton"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  style="cursor: pointer"
                ></i>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li
                    class="dropdown-item"
                    style="cursor: pointer"
                    @click="commentDelete(comment.id)"
                  >
                    削除
                  </li>
                </ul>
              </div>
              <div class="col-sm-11 mt-2">
                <div class="border-start ms-3 ps-2 border-dark">
                  <small>{{ comment.created_at }}</small>
                  <p>{{ comment.body }}</p>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group mt-2 mx-auto" style="max-width: 50rem">
                <textarea
                  name="body"
                  required
                  class="form-control"
                  rows="1"
                  placeholder="コメントを入力してください"
                  v-on:input="changeComment"
                ></textarea>
              </div>
            </div>
            <div class="d-grid col-sm-3 mt-2 float-end">
              <button
                class="btn btn-primary mb-3"
                type="button"
                @click="commentStore(answer.id)"
              >
                コメントを書く
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group mt-3 mx-auto" style="max-width: 50rem">
        <div class="card">
          <div class="card-header">あなたの回答</div>
          <textarea
            name="body"
            required
            class="form-control"
            rows="7"
            placeholder="回答を入力してください"
            v-model="answers_store.body"
          ></textarea>
        </div>
      </div>
      <div class="d-grid col-sm-6 mt-2 mx-auto">
        <button class="btn btn-primary" type="button" @click="answer">
          回答する
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import QuestionLike from "../components/QuestionLike.vue";
export default {
  components: { QuestionLike },
  props: {
    question_id: {
      type: [String, Number],
    },
  },
  data() {
    return {
      question: this.question,
      initialIsLikedBy: false,
      count_likes: 0,
      answers: {},
      answers_store: {},
      comment: {},
    };
  },
  computed: {
    user_id() {
      return this.$store.getters["auth/id"];
    },
    isLogin() {
      return this.$store.getters["auth/check"];
    },
  },
  methods: {
    async getQuestion() {
      const response = await axios.get(
        "/api/questions/" + this.question_id + "/show"
      );
      this.question = response.data.question;
      this.answers = response.data.answers;
      this.initialIsLikedBy = response.data.initialIsLikedBy;
      this.count_likes = response.data.count_likes;
    },
    async answer() {
      const response = await axios.put(
        "/api/answers/question/" + this.question.id,
        this.answers_store
      );
      this.getQuestion();
    },
    async answerDelete(id) {
      const response = await axios.delete("/api/answers/" + id);
      this.getQuestion();
    },
    async commentStore(id) {
      const response = await axios.put(
        "/api/answers/" + id + "/comment",
        this.comment
      );
      this.getQuestion();
    },
    async commentDelete(id) {
      const response = await axios.delete("/api/answers/comment/" + id);
      this.getQuestion();
    },
    async questionDelete(id) {
      const response = await axios.delete("/api/questions/" + id);
      this.$router.push({ name: "home" });
    },
    async bestAnswer(question_id, answer_id) {
      const response = await axios.put(
        "/api/questions/" + question_id + "/answers/" + answer_id
      );
      this.getQuestion();
    },
    changeComment(event) {
      this.comment.body = event.target.value;
    },
  },
  mounted() {
    this.getQuestion();
  },
};
</script>
