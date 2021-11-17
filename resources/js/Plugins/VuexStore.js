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

    mutations: {

        addToCart(state, { name, total_amount, quantity, product_number, id }) {
            if (quantity <= 0)
                delete state.sessionCart.products[product_number];
            else {
                state.sessionCart.products[product_number] = {
                    id,
                    name,
                    product_number,
                    quantity,
                    product_total: total_amount * 100,
                };
            }
            let total_amount_cart = Object.values(
                state.sessionCart.products
            ).reduce((initial_value, product) => {
                return (initial_value += product?.product_total);
            }, 0);
            state.sessionCart.total_amount_cart =
                parseFloat(total_amount_cart / 100).toFixed(2) || "0.00";

            this.dispatch("updateCart", {
                products: state.sessionCart.products,
                total_amount_cart,
            });
        },
    },

    actions: {
        updateCart(state, { products, total_amount_cart }) {
            let data = new FormData();
            data.append("products", products);
            data.append("total_amount_cart", total_amount_cart);
            axios.post(route("cart.store"), data).then((response) => {
                console.log(response.data);
            });
        },
    },

    modules: { offsetHeader },
});

export default store;
