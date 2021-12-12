<template>
  <div class="container">
    <div class="row">
      <h1 class="text-center mt-5">ログイン</h1>
      <div class="card mt-3 m-auto" style="width: 30rem">
        <div class="card-body">
          <div class="mx-auto">
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
              <div
                class="alert alert-danger"
                v-text="errors.email"
                v-if="errors.email"
              ></div>
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
              <div
                class="alert alert-danger"
                v-text="errors.password"
                v-if="errors.password"
              ></div>
            </div>
            <input type="hidden" name="remember" id="remember" value="on" />
            <div class="d-grid gap-2 col-sm-12 mx-auto">
              <button type="submit" class="btn btn-primary mt-3" @click="login">
                ログイン
              </button>
            </div>
            <div class="row mt-2">
              <a class="text-decoration-none col-sm-12 text-center text-dark"
                >ユーザー登録はこちら</a
              >
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
      email: "",
      password: "",
      errors: {},
    };
  },
  methods: {
    login() {
      this.errors = {};
      const params = {
        email: this.email,
        password: this.password,
        remember: this.remember,
      };
      axios
        .post("/login", params)
        .then((res) => {
          axios.push("/");
        })
        .catch((error) => {
          const responseErrors = error.res.data.errors;
          const errors = {};

          for (let key in responseErrors) {
            errors[key] = responseErrors[key][0];
          }
          this.errors = errors;
        });
    },
  },
};
</script>

