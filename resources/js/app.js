require('./bootstrap');
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vue from "vue";
import VueRouter from "vue-router";
import QuestionLike from "./components/QuestionLike";
import FollowButton from "./components/FollowButton";
import NavComponent from "./components/NavComponent";
import QuestionShow from "./components/questions/QuestionShow";
import Home from "./components/questions/Home";
import QuestionCreate from "./components/questions/QuestionCreate";
import QuestionEdit from "./components/questions/QuestionEdit";
import Login from "./components/auth/Login";
import Register from "./components/auth/Register";

Vue.use(VueRouter,BootstrapVue);
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/questions/:question",
            name: "questions.show",
            component: QuestionShow,
            props: true
        },
        {
            path: "/questions/",
            name: "questions.create",
            component: QuestionCreate,
        },
        {
            path: "/questions/:question/edit",
            name: "questions.edit",
            component: QuestionEdit,
            props: true,
        },
        {
            path: "/login",
            name: "login",
            component: Login,
            props: true,
        },
        {
            path: "/register",
            name: "rester",
            component: Register,
            props: true,
        },
    ]
});

const app = new Vue({
    el: "#app",
    router,
    components: {
        QuestionLike,
        FollowButton,
        NavComponent
    }
});
