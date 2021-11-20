<template>
    <Head title="Products" />
    <div
        class="
            max-w-7xl
            w-full
            p-5
            mx-auto
            sm:px-6
            lg:px-8
            flex flex-wrap
            justify-between
            sm:justify-around
        "
    >
        <menu-items :cart="passCart" />
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import MenuItems from "./Partials/MenuItems.vue";
import Cart from "@/app_modules/Cart";

export default defineComponent({
    components: {
        MenuItems,
        Head,
    },
    props: ["user", "session_cart"],
    layout: AppLayout,

    computed: {
        passCart() {
            return Cart.$getCart(this).cart;
        },
    },
});
</script>
