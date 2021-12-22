import Vue from "vue";
import VueRouter from "vue-router";

import QuestionShow from "./questions/QuestionShow";
import Home from "./questions/Home";
import QuestionCreate from "./questions/QuestionCreate";
import QuestionEdit from "./questions/QuestionEdit";
import AnswerEdit from "./answers/AnswerEdit";
import QuestionSearch from "./questions/QuestionSearch";
import User from "./users/User";
import Follower from "./users/Follower";
import Followee from "./users/Followee";
import Login from "./auth/Login";
import Register from "./auth/Register";
import SystemError from "./errors/System.vue";
import store from "./store/";
Vue.use(VueRouter);

const routes = [
    {
        path: "/login",
        name: "login",
        component: Login,
        beforeEnter(to, from, next) {
            if (store["auth/check"]) {
                next("/");
            } else {
                next();
            }
        }
    },
    {
        path: "/register",
        name: "register",
        component: Register
    },
    {
        path: "/500",
        name: "systemError",
        component: SystemError
    },
    {
        path: "/",
        name: "home",
        component: Home
    },
    {
        path: "/questions/:question_id/show",
        name: "questions.show",
        component: QuestionShow,
        props: true
    },
    {
        path: "/questions/",
        name: "questions.create",
        component: QuestionCreate
    },
    {
        path: "/questions/:question_id/edit",
        name: "questions.edit",
        component: QuestionEdit,
        props: true
    },
    {
        path: "/questions/search/:content",
        name: "questions.search",
        component: QuestionSearch,
        props: true
    },
    {
        path: "/answers/:answer_id/edit",
        name: "answers.edit",
        component: AnswerEdit,
        props: true
    },
    {
        path: "/users/:user_name",
        name: "users.show",
        component: User,
        props: true
    },
];

const router = new VueRouter({
    mode: "history",
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.isLogin === false) {
            next({
                path: "/login",
                query: { redirect: to.fullPath }
            });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
