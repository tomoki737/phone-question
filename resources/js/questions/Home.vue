 <template>
 <div>
  <div class="container" style="max-width: 800px">
    <div class="row">
      <ul class="nav nav-tabs mt-3 justify-content-center">
        <li class="nav-item">
          <div
            class="nav-link" style="cursor: pointer;"
            @click="changeTab(1)"
            v-bind:class="{ active: this.isActive === 1 }"
            >最近の解決済</div
          >
        </li>
        <li class="nav-item" style="cursor: pointer;">
          <div
            class="nav-link"
            @click="changeTab(2)"
            v-bind:class="{ active: this.isActive === 2 }"
            >未解決</div
          >
        </li>
      </ul>
      <question-solve
        v-show="this.isActive === 1"
        v-bind:questions="this.questions"
      ></question-solve>
      <question-un-solution
        v-show="this.isActive === 2"
        v-bind:questions="this.questions"
      ></question-un-solution>

    </div>
  </div>
  </div>
</template>

 <script>
import QuestionSolve from "../components/QuestionSolve.vue";
import QuestionUnSolution from "../components/QuestionUnSolution.vue";
export default {
  components: {
    QuestionSolve,
    QuestionUnSolution,
  },
  data() {
    return {
      isActive: 1,
      questions: {},
    };
  },
  methods: {
  async getQuestions() {
      const response = await axios.get('api');
      this.questions = response.data.questions;
    },
    changeTab(num) {
        this.isActive = num;
    },
  },
  mounted() {
    this.getQuestions();
  },
};
</script>
