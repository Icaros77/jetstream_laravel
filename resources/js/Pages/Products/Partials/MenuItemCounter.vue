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
                <add-to-cart @addToCart="addToCart" />
            </div>
            <div class="w-1/3 flex justify-end">
                <span
                    v-show="quantity_in_cart"
                    class="self-end text-sm text-red-600 font-bold"
                    >{{ quantity_in_cart }} in cart
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import AddToCart from "./AddToCart.vue";
import Cart from "@/app_modules/Cart";

export default defineComponent({
    components: {
        AddToCart,
    },
    props: {
        item: Object,
        cart: Object,
    },

    data() {
        return {
            total_amount: "0.00",
            quantity: 0,
            quantity_in_cart: this.getQuantity(),
        };
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
            const product = this.item;
            product.quantity = this.quantity;
            product.total_amount = this.total_amount;

            const product_data = Cart.$addToCart(this.cart, product);
            if (!product_data) return;

            const form = this.$inertia.form({ product_data });

            form.transform((data) => ({ ...data })).post(route("cart.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    this.quantity = 0;
                    this.total_amount = "0.00";
                    this.quantity_in_cart =
                        this.cart[product_data.product_number].quantity;
                    
                    let cart_icon = document.querySelector("#cart_icon");
                    let svg = cart_icon.querySelector("svg");
                    cart_icon.classList.add("bg-red-400");
                    svg.classList.remove("text-red-400");
                    svg.classList.add("text-gray-100");
                    setTimeout(() => {
                        cart_icon.classList.remove("bg-red-400");
                        svg.classList.remove("text-gray-100");
                        svg.classList.add("text-red-400");
                    }, 1000);
                },
            });
        },

        getQuantity() {
            return this.cart[this.item.product_number]?.quantity || 0;
        },
    },
});
</script>
