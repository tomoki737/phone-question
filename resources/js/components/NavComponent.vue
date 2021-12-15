<template>
  <nav
    class="
      navbar navbar-expand-sm navbar-light
      border-bottom
      py-3
      bg-white
      mb-3
    "
  >
    <div class="container-fluid">
      <router-link v-bind:to="{ name: 'home' }">
        <a class="navbar-brand">Navbar</a>
      </router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <!-- <form class="d-flex align-items-end" action="{{route('questions.search')}}" method="post">
                    @csrf
                    @method('put')
                    <div class="input-group ">
                        <input type="search" class="form-control" placeholder="質問を検索" aria-label="Search" aria-describedby="button-addon2" name="content" value="{{$content ?? old('content')}}">
                        <button class="btn btn-outline-secondary" type="hidden" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </form> -->
          <li class="nav-item" v-if="!this.isLogin">
            <router-link v-bind:to="{ name: 'login' }">
              <a class="nav-link active" aria-current="page">ログイン</a>
            </router-link>
          </li>
          <li class="nav-item" v-if="!this.isLogin">
            <router-link v-bind:to="{ name: 'register' }">
              <a class="nav-link active" aria-current="page">新規登録</a>
            </router-link>
          </li>
          <li class="nav-item"  v-if="this.isLogin">
            <div class="d-grid gap-2 d-md-block mt-sm-2 ms-3">
              <router-link v-bind:to="{ name: 'questions.create' }">
                <a
                  class="nav-link btn btn-primary text-white"
                  aria-current="page"
                  role="button"
                  >質問する</a
                >
              </router-link>
            </div>
          </li>
          <li class="nav-item dropdown me-2" v-if="this.isLogin">
            <div class="btn-group">
              <button
                type="button"
                class="btn dropdown-toggle"
                data-bs-toggle="dropdown"
                data-bs-display="static"
                aria-expanded="false"
              >
                <i class="far fa-user-circle fa-2x"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-lg-end">
                <li><a class="dropdown-item">マイページ</a></li>
                <li>
                  <hr class="dropdown-divider" />
                  <button
                    form="logout-button"
                    class="dropdown-item"
                    type="hidden"
                    @click="logout"
                  >
                    ログアウト
                  </button>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
data() {
    return {
        isLogin: false,
    }
},
    methods: {
      logout() {
        axios
          .post("/logout")
          .then((res) => {
            this.getIsLogin();
          })
          .catch((error) => {
            console.error(error);
          });
      },
      getIsLogin() {
          axios.get("/api/isLogin")
          .then((res) => {
             this.isLogin = res.data.isLogin;
          });
      }
    },
  created(){
      this.getIsLogin();
  },
};
</script>
