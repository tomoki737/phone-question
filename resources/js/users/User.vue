<template>
  <div class="container mt-4" style="max-width: 800px">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <p class="p-2">{{ user.name }}さんのページ</p>
              <div class="col-sm ps-sm-4">
                <i class="far fa-user-circle fa-4x ms-2"></i>
                <p>{{ user.name }}</p>
              </div>
              <!-- @if(Auth::id() !== user.id) -->
              <div class="col-sm text-sm-end">
                <!-- <follow-button :initial-is-followed-by='@json(user.isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => user.name]) }}"></follow-button> -->
              </div>
              <!-- @endif -->
            </div>
            <div class="col-sm p-2 ps-sm-3">
              <a class="text-decoration-none text-dark me-2">フォロー </a>
              <a class="text-decoration-none text-dark">フォロワー</a>
              <!-- <a class="text-decoration-none text-dark me-2">フォロー {{user.count_followings}}</a>
            <a  class="text-decoration-none text-dark">フォロワー {{user.count_followers}}</a> -->
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <ul class="nav nav-pills nav-justified my-2">
            <li class="nav-item bg-white mx-1" style="border-radius: 12px">
              <!-- <a
              href="{{ route('users.show', ['name' => $user->name]) }}"
              class="nav-link px-1 pt-1 pb-0 btn btn-sm {{$hasQuestion ? 'active' : ''}}"
            > -->
              <div
                class="nav-link px-1 py-2 pt-1 pb-0 btn btn-sm"
                @click="changeTab(1)"
                v-bind:class="{ active: isActive === 1 }"
              >
                質問
              </div>
              <!-- </a> -->
            </li>
            <li class="nav-item bg-white mx-1" style="border-radius: 12px">
              <!-- <a
              href="{{ route('users.answers', ['name' => $user->name]) }}"
              class="nav-link px-1 pt-1 pb-0 btn btn-sm {{$hasAnwer ? 'active' : ''}}"
            > -->
              <div
                class="nav-link px-1 pt-1 py-2 pb-0 btn btn-sm"
                @click="changeTab(2)"
                v-bind:class="{ active: isActive === 2 }"
              >
                回答
              </div>
              <!-- </a> -->
            </li>
            <li
              class="nav-item bg-white mx-1 active"
              style="border-radius: 12px"
            >
              <!-- <a
              href="{{ route('users.likes', ['name' => $user->name]) }}"
              class="nav-link px-1 pt-1 pb-0 btn btn-sm {{$hasLike ? 'active' : ''}}"
            > -->
              <div
                class="nav-link px-1 pt-1 py-2 pb-0 btn btn-sm"
                @click="changeTab(3)"
                v-bind:class="{ active: isActive === 3 }"
              >
                いいね
              </div>
              <!-- </a> -->
            </li>
          </ul>
        </div>
        <div class="col-sm-12">
          <user-question
            v-show="isActive === 1"
            :user_name="user_name"
          ></user-question>
          <user-answer
            v-show="isActive === 2"
            :user_name="user_name"
          ></user-answer>
          <user-like v-show="isActive === 3" :user_name="user_name"></user-like>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import UserQuestion from "./UserQuestion.vue";
import UserAnswer from "./UserAnswer.vue";
import UserLike from "./UserLike.vue";
export default {
  components: {
    UserQuestion,
    UserAnswer,
    UserLike,
  },
  props: {
    user_name: {
      type: String,
    },
  },
  data() {
    return {
      user: {},
      isActive: 1,
    };
  },
  methods: {
    async getUser() {
      const response = await axios.get("/api/users/" + this.user_name);
      this.user = response.data.user;
    },
    changeTab(num) {
      this.isActive = num;
    },
  },
  mounted() {
    this.getUser();
  },
};
</script>
