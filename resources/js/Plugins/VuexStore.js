import { createStore } from "vuex";
import offsetHeader from "./Modules/offsetHeaderModule";

const store = createStore({
    namespaced: true,

    state: {
        
    },

    modules: { offsetHeader },
});

export default store;
