const module = {
    namespaced: true,
    state: {
        show: false,
        nameButton: 'Menu'
    },
    getters: {
        getShow(state) {
            return state.show;
        },
    },
    mutations: {
        toggleMenu(state, payload) {
            if(payload.nameButton === state.nameButton) {
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
