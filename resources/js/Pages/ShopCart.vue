<template>
    <section
        class="
            max-w-7xl
            p-5
            mx-auto
            sm:px-6
            lg:px-8
            flex flex-wrap
            justify-center
            sm:justify-around
        "
    >
        <shop-cart-items v-if="cart" />
        <shop-cart-empty v-else />
    </section>
</template>

<script>
import { defineComponent } from "vue";
import store from "../Plugins/VuexStore";
import AppLayoutVue from "../Layouts/AppLayout.vue";
import ShopCartItems from "./ShopCartItems/ShopCartItems.vue";
import ShopCartEmpty from "./ShopCartItems/ShopCartEmpty.vue";

export default defineComponent({
    components: {
        ShopCartItems,
        ShopCartEmpty,
    },
    layout: AppLayoutVue,
    store: store,
    computed: {
        cart() {
            let cart = this.$page.props.user.cart.cart;
            if(!cart) return;
            return Object.keys(cart.products).length > 0;
        },
    },
});
</script>
