<template>
    <div class="sm:w-full flex flex-col">
        <div class="sm:w-full flex justify-around">
            <div class="w-2/3 flex justify-center items-center">
                <span class="text-gray-700 font-bold"
                    >{{ total_amount }} €
                </span>
            </div>
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
                    @input="changeAmount"
                />
            </div>
        </div>
        <div class="w-full p-3 flex justify-between">
            <div
                class="w-2/3 flex justify-start"
                :class="{ visible: quantity, invisible: !quantity }"
            >
                <button
                    @click="addToCart"
                    type="button"
                    class="
                        w-3/5
                        text-white
                        bg-gradient-to-br
                        from-indigo-300
                        to-indigo-500
                        font-bold
                        text-xs
                        p-2
                        rounded-md
                    "
                >
                    Add to cart
                </button>
            </div>
            <div class="w-1/3 flex justify-end">
                <span
                    v-show="quantity"
                    class="self-end text-sm text-red-600 font-bold"
                    >{{ quantity }} in cart
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import { mapGetters, mapMutations } from "vuex";

export default defineComponent({
    components: {
        JetButton,
    },
    setup(props) {
        const setTotal = function () {
            let product_number = props.item.product_number;
            const cart = props.cart;
            if (!cart) return "0.00";

            let product = cart.products[product_number];

            if (!product) return "0.00";

            return parseFloat(product.total_amount / 100).toFixed(2) || "0.00";
        };

        return { setTotal };
    },
    props: {
        item: Object,
        cart: Object,
    },

    data() {
        return {
            total_amount: this.setTotal(),
            quantity: this.getQuantity(this.item.product_number),
        };
    },
    computed: {
        ...mapGetters(["getSessionCart"]),
    },
    methods: {
        changeAmount(event) {
            let value = event.target.value.match(/([^\d]+)/g, "");
            if (value) {
                this.quantity = 0;
                this.total_amount = "0.00";
                return;
            }
            value = Number(event.target.value) || this.quantity || 0;
            if (value < 0) value = 0;
            this.total_amount = (value * (this.item.price / 100)).toFixed(2);
            this.quantity = value;
        },
        addToCart() {
            this.addToCart({
                id: this.item.id,
                name: this.item.name,
                total_amount: this.total_amount,
                quantity: this.quantity,
                product_number: this.item.product_number,
            });
        },
        getQuantity(product_number) {
            return this.cart.products[product_number]?.quantity || 0;
        },
        ...mapMutations(["addToCart"]),
    },
});
</script>
