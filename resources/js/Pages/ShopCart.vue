<template>
    <div class="py-12">
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
            <shop-cart-items />
        </section>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import store from "../Plugins/VuexStore";
import AppLayoutVue from "../Layouts/AppLayout.vue";
import ShopCartItems from "./ShopCartItems/ShopCartItems.vue";

export default defineComponent({
    components: {
        ShopCartItems,
    },
    layout: AppLayoutVue,
    store: store,
});
</script>
