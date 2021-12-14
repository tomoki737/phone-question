<template>
  <div class="container">
    <div class="row">
      <h1 class="text-center mt-5">ログイン</h1>
      <div class="card mt-3 m-auto" style="width: 30rem">
        <div class="card-body">
          <div class="mx-auto">
            <p v-show="isError">認証に失敗しました。</p>
            <div class="form-group my-3">
              <label for="email">メールアドレス</label>
              <div class="col-sm-12 mx-auto mt-2">
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="メールアドレス"
                  v-model="email"
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
                  v-model="password"
                />
              </div>
            </div>
            <div class="form-group mb-2">
              <label>
                <input type="checkbox" v-model="remember" /> 次回から省略
              </label>
            </div>
            <input type="hidden" name="remember" id="remember" value="on" />
            <div class="d-grid gap-2 col-sm-12 mx-auto">
              <button type="submit" class="btn btn-primary mt-3" @click="login">
                ログイン
              </button>
            </div>
            <router-link v-bind:to="{ name: 'questions.show' }">
              <div class="row mt-2">
                <a class="text-decoration-none col-sm-12 text-center text-dark"
                  >ユーザー登録はこちら</a
                >
              </div>
            </router-link>
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
      email: "",
      password: "",
      remember: false,
      isError: false,
    };
  },
  methods: {
    login() {
        axios
          .post("/login", {
            email: this.email,
            password: this.password,
            remember: this.remember,
          })
          .then((res) => {
              this.$router.push({ name: "home" });
          })
          .catch((error) => {
            this.isError = true;
          });
    },
  },
};
</script>

