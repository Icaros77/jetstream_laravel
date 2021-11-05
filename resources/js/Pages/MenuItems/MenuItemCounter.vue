<template>
    <div class="sm:w-full flex flex-col">
        <div class="sm:w-full flex justify-around">
            <jet-button
                @click="increase_total(item.price)"
                :classes="'btn-add'"
                type="button"
            >
                +
            </jet-button>
            <span
                class="flex justify-center items-center text-red-400 font-bold"
                >{{ quantity }}</span
            >
            <jet-button
                @click="decrease_total(item.price)"
                :classes="'btn-sub'"
                type="button"
                >-</jet-button
            >
        </div>
        <span class="inline-block p-3 text-center text-gray-700 font-bold"
            >{{ total_product }} €
        </span>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import JetButton from "../../Jetstream/Button.vue";

export default defineComponent({
    components: {
        JetButton,
    },
    props: {
        item: {
            type: Object,
        },
    },

    data() {
        return {
            total_product: "0",
            quantity: 0,
        };
    },
    methods: {
        increase_total(price) {
            price = Number(price);
            this.total_product = parseFloat(this.total_product);
            this.total_product = (this.total_product + price).toFixed(2);
            this.quantity++;
        },
        decrease_total(price) {
            if (this.total_product <= 0) return;
            price = Number(price);
            this.total_product = parseFloat(this.total_product);
            this.total_product = (this.total_product - price).toFixed(2);
            this.quantity--;
            if (this.total_product < 0) this.total_product = "0";
        },
    },
});
</script>
