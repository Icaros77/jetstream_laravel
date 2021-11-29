<template>
    <Head title="Products" />
    <div class="flex justify-center w-full">
        <filter-bar />
    </div>

    <div
        class="
            max-w-7xl
            w-full
            p-5
            mx-auto
            sm:px-6
            lg:px-8
            flex
            flex-wrap
            justify-between
            sm:justify-around
        "
    >
        <show-criterias
            v-if="filter"
            :filter="filter"
            :name="name"
            :category="category"
            :vendor="vendor"
            :products="hasProducts"
        />
        <products-present
            v-if="hasProducts"
            :products="products"
            :cart="passCart"
        />
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import ProductsPresent from "./Partials/ProductsPresent.vue";
import ShowCriterias from "./Partials/ShowResultCriterias.vue";
import FilterBar from "./Partials/FilterBar.vue";
import Cart from "@/app_modules/Cart";

export default defineComponent({
    components: {
        FilterBar,
        ProductsPresent,
        ShowCriterias,
        Head,
    },
    props: [
        "user",
        "session_cart",
        "products",
        "filter",
        "name",
        "vendor",
        "category",
    ],
    layout: AppLayout,

    computed: {
        passCart() {
            return Cart.$getCart(this).cart;
        },
        hasProducts() {
            return this.products.data.length !== 0;
        },
    },
});
</script>
