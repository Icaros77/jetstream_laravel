import axios from "axios";
import { createStore } from "vuex";
import offsetHeader from "./Modules/offsetHeaderModule";

const store = createStore({
    namespaced: true,
    state: {
        user: null,
    },
    getters: {
        isLoggedIn(state) {
            return state.user ? true : false;
        },
        getUser(state) {
            return state.user;
        },
    },
    mutations: {
        assignUser(state, { user }) {
            state.user = user;
        },
        destroyUser(state) {
            state.user = null;
        },
        checkSession() {
            axios.post(route("checkSession")).then((response) => {
                const user = Object.keys(response.data).length
                    ? response.data
                    : null;
                store.commit("assignUser", { user });
            });
        },
    },
    actions: {
        logUser({ commit }, { formData }) {
            axios.post(route("login"), formData).then((response) => {
                commit("assignUser", { user: response.data });
            });
        },
        logoutUser({ commit }) {
            axios.post(route("logout")).then(() => {
                commit("destroyUser");
            });
        },
    },

    modules: { offsetHeader },
});

export default store;
