 <template>
 <div>
 <nav-component></nav-component>
  <div class="container" style="max-width: 800px">
    <div class="row">
      <ul class="nav nav-tabs mt-3 justify-content-center">
        <li class="nav-item">
          <a
            class="nav-link"
            @click="changeTab(1)"
            v-bind:class="{ active: this.isActive === 1 }"
            >最近の解決済</a
          >
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            @click="changeTab(2)"
            v-bind:class="{ active: this.isActive === 2 }"
            >未解決</a
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
import NavComponent from '../components/NavComponent.vue';
import QuestionSolve from "../components/QuestionSolve.vue";
import QuestionUnSolution from "../components/QuestionUnSolution.vue";
export default {
  components: {
    QuestionSolve,
    QuestionUnSolution,
    NavComponent,
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
