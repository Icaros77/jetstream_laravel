<template>
    <article
        class="flex p-5"
        v-for="(product, product_number) in cart.products"
        :key="product_number"
    >
        <div>{{ product.name }}</div>
    </article>
    <div>{{ cart.total_amount_cart }}</div>
</template>

<script>
import { defineComponent } from "vue";
import AppLayoutVue from "../../Layouts/AppLayout.vue";
import AddToCartButton from "@/components/Products/Buttons/AddToCart.vue";

export default defineComponent({
    components: {
        AddToCartButton,
    },
    layout: AppLayoutVue,
    props: {
        cart: Object
    },
});
</script>
