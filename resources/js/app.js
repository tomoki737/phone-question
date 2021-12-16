import "./bootstrap";
import BootstrapVue from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import Vue from "vue";
import VueRouter from "vue-router";
import store from "./store/";
import router from "./router";
import App from "./App.vue";

Vue.use(VueRouter, BootstrapVue);
const app = async () => {
    await store.dispatch('auth/currentUser');
    new Vue({
        el: "#app",
        store,
        router,
        components: {
            App
        },
        template: "<App/>"
    });
};

app()
;
