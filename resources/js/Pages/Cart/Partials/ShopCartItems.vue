<template>
    <article
        class="flex flex-col p-5 w-full bg-indigo-400 rounded-lg"
        v-for="product in cart.cart"
        :key="product.id"
    >
        <div>
            <span class="text-white">{{ product.name }}</span>
        </div>
        <div>
            <span class="text-white">{{ product.quantity }}</span>
        </div>
        <div>
            <span class="text-white">{{ total_amount(product) }} €</span>
        </div>
    </article>
    <div>{{ total_amount_cart }} €</div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: {
        cart: Object,
    },
    computed: {
        total_amount_cart() {
            let total_amount = parseFloat(
                this.cart.total_amount_cart / 100
            );
            console.log(this.cart);
            return total_amount?.toFixed(2) || "0.00";
        },
    },
    methods: {
        total_amount(product) {
            let total_amount = parseFloat(product.total_amount / 100);
            return total_amount?.toFixed(2) || "0.00";
        },
    },
});
</script>
