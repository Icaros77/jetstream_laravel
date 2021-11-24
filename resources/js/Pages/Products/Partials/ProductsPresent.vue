<template>
    <navigation :products="products" />
    <menu-items :cart="cart" :products="products" />
    <navigation :products="products" />
</template>

<script>
import { defineComponent } from "vue";
import MenuItems from "./MenuItems.vue";
import Navigation from "./NavigationFilterResult.vue";
import ShowCriterias from "./ShowResultCriterias.vue";

export default defineComponent({
    components: { MenuItems, Navigation, ShowCriterias },
    props: ["cart", "products"],
});
</script>
