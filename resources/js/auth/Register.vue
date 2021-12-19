<template>
  <div>
    <div class="container">
      <div class="row">
        <h1 class="text-center mt-5">ユーザー登録</h1>
        <div class="card mt-3 m-auto" style="width: 35rem">
          <div class="card-body">
            <div class="mx-auto">
              <div class="card-body">
                <div v-if="registerErrors" class="errors">
                <ul v-if="registerErrors.email">
                  <li v-for="msg in registerErrors.email" :key="msg">{{msg}}</li>
                </ul>
                <ul v-if="registerErrors.password">
                  <li v-for="msg in registerErrors.password" :key="msg">
                    {{msg}}
                  </li>
                </ul>
              </div>
                <div class="form-group my-3">
                  <label for="name">ユーザー名</label>
                  <div class="col-sm-12 mx-auto mt-2">
                    <input
                      type="name"
                      class="form-control"
                      id="name"
                      name="name"
                      placeholder="ユーザー名を入力"
                      v-model="registerForm.name"
                    />
                  </div>
                  <small>英数字3〜16文字</small>
                </div>
                <div class="form-group my-3">
                  <label for="email">メールアドレス</label>
                  <div class="col-sm-12 mx-auto mt-2">
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      name="email"
                      placeholder="メールアドレスを入力"
                      v-model="registerForm.email"
                    />
                  </div>
                </div>
                <div class="form-groupm mb-3">
                  <label for="password">パスワード</label>
                  <div class="col-sm-12 mx-auto mt-2">
                    <input
                      type="password"
                      class="form-control"
                      id="password"
                      name="password"
                      placeholder="パスワードを入力"
                      required
                      v-model="registerForm.password"
                    />
                  </div>
                </div>
                <div class="form-groupm mb-3">
                  <label for="password_confirmation">パスワード（確認）</label>
                  <div class="col-sm-12 mx-auto mt-2">
                    <input
                      type="password"
                      class="form-control"
                      id="password_confirmation"
                      name="password_confirmation"
                      placeholder="パスワードを確認"
                      v-model="registerForm.password_confirmation"
                    />
                  </div>
                </div>
              </div>
              <div class="card-body text-center">
                <div class="d-grid gap-2 col-12 mx-auto">
                  <button
                    class="btn btn-primary"
                    type="hidden"
                    @click="register"
                  >
                    登録
                  </button>
                </div>
              </div>
              <div class="card-body pt-0 text-center">
                <p class="card-title border-top pt-4">
                  <span>アカウントを</span>
                  <span>お持ちの方はこちら</span>
                </p>
                <router-link
                  v-bind:to="{ name: 'register' }"
                  class="text-decoration-none"
                >
                  <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="hidden" class="btn btn-outline-success mt-2">
                      ログイン
                    </button>
                  </div>
                </router-link>
              </div>

              <div class="card-body pt-0 text-center">
                <p class="card-title border-top pt-4">
                  <span>ユーザー登録せずに</span>
                  <span>機能を試したい方はこちら</span>
                </p>
                <div class="d-grid gap-2 col-12 mx-auto">
                  <button
                    type="hidden"
                    class="btn btn-outline-danger mt-2"
                    @click="guestLogin"
                  >
                    ゲストユーザーログイン
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import NavComponent from "../components/NavComponent.vue";
export default {
  components: {
    NavComponent,
  },
  data() {
    return {
      registerForm: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      isError: false,
    };
  },
  methods: {
    async register() {
      await this.$store.dispatch('auth/register', this.registerForm)
      if(this.apiStatus) {
      this.$router.push({ name: "home" });
      }
    },
    guestLogin() {
      axios
        .get("/api/guest")
        .then((res) => {
          this.$router.push({ name: "home" });
        })
        .catch((error) => {
          this.isError = true;
        });
    },
      clearError() {
    this.$store.commit("auth/setLoginErrorMessages", null);
  },
  },

  computed: {
    apiStatus() {
      return this.$store.state.auth.apiStatus;
    },
    registerErrors() {
      return this.$store.state.auth.registerErrorMessages;
    },
  },
  created() {
    this.clearError();
  },
};
</script>
