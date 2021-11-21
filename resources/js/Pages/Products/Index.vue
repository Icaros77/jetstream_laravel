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
        <show-criterias v-if="filter" :filter="filter" :name="name" :category="category" :vendor="vendor" />
        <navigation :products="products" />
        <menu-items :cart="passCart" :products="products"/>
        <navigation :products="products" />
        <filter-bar />
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import MenuItems from "./Partials/MenuItems.vue";
import FilterBar from "./Partials/FilterBar.vue";
import Navigation from "./Partials/NavigationFilterResult.vue";
import ShowCriterias from "./Partials/ShowResultCriterias.vue";
import Cart from "@/app_modules/Cart";

export default defineComponent({
    components: {
        MenuItems,
        FilterBar,
        Navigation,
        ShowCriterias,
        Head,
    },
    props: ["user", "session_cart", "products", "filter", "name", "vendor", "category"],
    layout: AppLayout,

    computed: {
        passCart() {
            return Cart.$getCart(this).cart;
        }
    },
});
</script>
