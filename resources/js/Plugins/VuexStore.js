import axios from "axios";
import { createStore } from "vuex";
import offsetHeader from "./Modules/offsetHeaderModule";

const store = createStore({
    namespaced: true,

    state: {
        sessionCart: {
            products: {},
            total_amount_cart: "0.00",
        },
    },

    getters: {
        getSessionCart(state) {
            return state.sessionCart;
        },
        getProductQuantity(state, { product_number }) {
            return state.sessionCart.products[product_number].quantity;
        },
    },


    modules: { offsetHeader },
});

export default store;
