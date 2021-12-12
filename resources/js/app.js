require('./bootstrap');
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vue from "vue";
import VueRouter from "vue-router";
import store from "./store"
import router from './router';
import NavComponent from "./components/NavComponent";
window.state = store.state;

Vue.use(VueRouter,BootstrapVue);
const app = new Vue({
    el: "#app",
    router,
    components: {
        NavComponent
    }
});
