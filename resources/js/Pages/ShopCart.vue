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
        <shop-cart-items v-if="isCartEmpty" :cart="cart" />
        <shop-cart-empty v-else />
    </section>
</template>

<script>
import { defineComponent } from "vue";
import AppLayoutVue from "../Layouts/AppLayout.vue";
import ShopCartItems from "@/components/ShopCartItems/ShopCartItems.vue";
import ShopCartEmpty from "@/components/ShopCartItems/ShopCartEmpty.vue";
import store from "@/Plugins/VuexStore";
import { mapGetters } from "vuex";

export default defineComponent({
    components: {
        ShopCartItems,
        ShopCartEmpty,
    },

    props: ["user"],
    layout: AppLayoutVue,
    store: store,
    computed: {
        isCartEmpty() {
            let cart = this.cart();

            return Object.keys(cart.products).length > 0;
        },
        cart() {
            return Object.keys(this.user.cart.cart.products)
                ? this.user.cart.cart
                : this.getSessionCart;
        },
        ...mapGetters(["getSessionCart"]),
    },
});
</script>
