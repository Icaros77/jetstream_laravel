const module = {
    namespaced: true,
    state: {
        show: false,
    },
    getters: {
        getShow(state) {
            return state.show;
        },
    },
    mutations: {
        toggleMenu(state, { nameButton, buttonActive }) {
            if (nameButton === "Menu") state.show = !buttonActive;
            else state.show = false;
        },
        defaultMenu(state) {
            state.show = false;
        },
    },
};

export default module;
