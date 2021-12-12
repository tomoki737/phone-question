import Vue from "vue";
import VueRouter from "vue-router";

import QuestionLike from "./components/QuestionLike";
import FollowButton from "./components/FollowButton";
import QuestionShow from "./components/questions/QuestionShow";
import Home from "./components/questions/Home";
import QuestionCreate from "./components/questions/QuestionCreate";
import QuestionEdit from "./components/questions/QuestionEdit";
import Login from "./components/auth/Login";
import Register from "./components/auth/Register";
Vue.use(VueRouter);

const routes = [
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
    },
    {
        path: "/register",
        name: "register",
        component: Register,
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (state.isLogin === false) {
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
