<template>
    <Head title="Cart" />
    <section
        class="
            max-w-7xl
            w-full
            p-5
            mx-auto
            sm:px-6
            lg:px-8
            flex flex-wrap
            justify-center
            sm:justify-around
        "
    >
        <shop-cart-items v-if="isCartEmpty" :cart="cart()" />
        <shop-cart-empty v-else />
    </section>
</template>

<script>
import { defineComponent } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import AppLayoutVue from "@/Layouts/AppLayout.vue";
import ShopCartItems from "./Partials/ShopCartItems.vue";
import ShopCartEmpty from "./Partials/ShopCartEmpty.vue";
import Cart from "@/app_modules/Cart";

export default defineComponent({
    components: {
        ShopCartItems,
        ShopCartEmpty,
        Head
    },

    props: ["user", "session_cart"],
    layout: AppLayoutVue,
    computed: {
        isCartEmpty() {
            const cart = this.cart().cart;
            return cart && Object.keys(cart).length > 0;
        },
    },
    methods: {
        cart() {
            return Cart.$getCart(this);
        }
    }
});
</script>
