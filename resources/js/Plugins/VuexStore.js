import { createStore } from "vuex";
import offsetHeader from "./Modules/offsetHeaderModule";

const store = createStore({
    state: {},
    getters: {},
    mutations: {},

    modules: {offsetHeader,}
});

export default store;
