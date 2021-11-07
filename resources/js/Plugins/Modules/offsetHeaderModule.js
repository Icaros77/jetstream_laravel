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
        toggleMenu(state, payload) {
            if(payload.nameButton === 'Menu' || payload.nameButton === 'Login') {
                state.show = !payload.buttonActive;
            }else {
                state.show = false;
            }
        },
        defaultMenu(state) {
            state.show = false;
        }
    },
};

export default module;
