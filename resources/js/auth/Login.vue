<template>
  <div>
    <div class="container">
      <div class="row">
        <h1 class="text-center mt-5">ログイン</h1>
        <div class="card mt-3 m-auto" style="width: 30rem">
          <div class="card-body">
            <div class="mx-auto">
              <div v-if="loginErrors" class="errors">
                <ul v-if="loginErrors.email">
                  <li v-for="msg in loginErrors.email" :key="msg">{{msg}}</li>
                </ul>
                <ul v-if="loginErrors.password">
                  <li v-for="msg in loginErrors.password" :key="msg">
                    {{msg}}
                  </li>
                </ul>
              </div>
              <div class="form-group my-3">
                <label for="email">メールアドレス</label>
                <div class="col-sm-12 mx-auto mt-2">
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="メールアドレス"
                    v-model="loginForm.email"
                  />
                </div>
              </div>
              <div class="form-groupm mb-2">
                <label for="exampleInputPassword1">パスワード</label>
                <div class="col-sm-12 mx-auto mt-2">
                  <input
                    type="password"
                    class="form-control"
                    id="exampleInputPassword1"
                    name="password"
                    placeholder="パスワード"
                    v-model="loginForm.password"
                  />
                </div>
              </div>
              <input type="hidden" name="remember" id="remember" value="on" />
              <div class="d-grid gap-2 col-sm-12 mx-auto">
                <button
                  type="submit"
                  class="btn btn-primary mt-3"
                  @click="login"
                >
                  ログイン
                </button>
              </div>
              <router-link v-bind:to="{ name: 'register' }">
                <div class="row mt-2">
                  <a
                    class="text-decoration-none col-sm-12 text-center text-dark"
                    >ユーザー登録はこちら</a
                  >
                </div>
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      loginForm: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    async login() {
      await this.$store.dispatch("auth/login", this.loginForm);
      if (this.apiStatus) {
        this.$router.push({ name: "home" });
      }
    },
    clearError() {
        this.$store.commit('auth/setLoginErrorMessages', null)
    }
  },
  computed: {
    apiStatus() {
      return this.$store.state.auth.apiStatus;
    },
    loginErrors() {
      return this.$store.state.auth.loginErrorMessages;
    },
  },
  created() {
      this.clearError();
  }
};
</script>

