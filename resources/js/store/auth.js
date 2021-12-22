import Axios from "axios";
import { OK, UNPROCESSABLE_ENTITY } from "../util";

const state = {
    user: null,
    apiStatus: null,
    loginErrorMessages: null,
    registerErrorMessages: null
};

const getters = {
    check: state => !!state.user,
    name: state => (state.user ? state.user.name : ""),
    id: state => (state.user ? state.user.id : ""),
    user: state => (state.user ? state.use : "")
};

const mutations = {
    setUser(state, user) {
        state.user = user;
    },
    setApiStatus(state, status) {
        state.apiStatus = status;
    },
    setLoginErrorMessages(state, messages) {
        state.loginErrorMessages = messages;
    },
    setRegisterErrorMessages(state, messages) {
        state.registerErrorMessages = messages;
    }
};

const actions = {
    async register(context, data) {
        context.commit("setApiStatus", null);
        const response = await Axios.post("/api/register", data);
        if (response.status == 200) {
            context.commit("setApiStatus", true);
            context.commit("setUser", null);
            context.commit("setUser", response.data.user);
            return false;
        }
        context.commit("setApiStatus", false);
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit("setRegisterErrorMessages", response.data.errors);
        } else {
            context.commit("error/setCode", response.status, { root: true });
        }
    },
    async login(context, data) {
        context.commit("setApiStatus", null);
        const response = await Axios.post("/api/login", data);
        if (response.status == OK) {
            context.commit("setApiStatus", true);
            context.commit("setUser", response.data);
            return false;
        }
        context.commit("setApiStatus", false);
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit("setLoginErrorMessages", response.data.errors);
        } else {
            context.commit("error/setCode", response.status, { root: true });
        }
    },
    async logout(context) {
        const response = await Axios.post("/api/logout");
        if (response.status == OK) {
            context.commit("setApiStatus", true);
            context.commit("setUser", null);
            return false;
        }
    },
    async currentUser(context) {
        const response = await Axios.get("/api/user");
        const user = response.data || null;
        if (response.status === OK) {
            context.commit('setApiStatus', true)
            context.commit('setUser', user)
            return false
          }

          context.commit('setApiStatus', false)
          context.commit('error/setCode', response.status, { root: true })
        }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
