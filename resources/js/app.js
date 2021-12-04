import './bootstrap'
import Vue from 'vue'
import QuestionLike from './components/QuestionLike'
import FollowButton from './components/FollowButton'
import QuestionSearch from './components/QuestionSearch'

const app = new Vue({
  el: '#app',
  components: {
    QuestionLike,
    FollowButton,
    QuestionSearch,
  }
})
