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
            <div class="inline-flex w-1/3 justify-center items-center">
                <input
                    type="text"
                    class="
                        w-full
                        text-red-400
                        rounded-md
                        font-bold
                        focus:ring-red-400
                        border-0
                        shadow-inner
                        text-center
                        bg-transparent
                    "
                    v-model="quantity"
                    @input.number="changeAmmount"
                />
            </div>
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
import JetButton from "@/Jetstream/Button.vue";

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
            price = Number(price / 100);
            this.total_product = parseFloat(this.total_product);
            this.total_product = (this.total_product + price).toFixed(2);
            this.quantity++;
        },
        decrease_total(price) {
            if (this.total_product <= 0) return;
            price = Number(price / 100);
            this.total_product = parseFloat(this.total_product);
            this.total_product = (this.total_product - price).toFixed(2);
            this.quantity--;
            if (this.total_product < 0) this.total_product = "0";
        },
        changeAmmount(event) {
            let value = event.target.value;
            if (value < 0) value = 0;
            this.total_product = (value * this.item.price).toFixed(2);
        },
    },
});
</script>
