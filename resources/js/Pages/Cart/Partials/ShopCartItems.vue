<template>
    <div>
        <div
            class="
                w-full
                flex flex-wrap
                justify-between
                md:max-w-md
                p-3
                sm:ml-auto sm:justify-around
            "
        >
            <div class="w-max p-3 indigo-gradient-rounded shadow-lg">
                <span class="font-bold text-lg text-white">
                    Total cart: {{ total_amount_cart }} €
                </span>
            </div>
            <div class="w-max indigo-gradient-rounded shadow-lg">
                <form @submit.stop.prevent="placeOrder" class="w-full">
                    <button
                        type="submit"
                        class="text-white font-bold w-full p-3"
                    >
                        Place order!
                    </button>
                </form>
            </div>
        </div>
        <div
            class="
                flex flex-wrap
                justify-center
                sm:justify-around
                w-full
                max-h-screen
                pt-5
                space-y-5
                md:max-w-4xl
                sm:space-y-0
                overflow-y-scroll
            "
        >
            <article
                class="flex w-full sm:w-2/5 bg-gray-100 rounded-lg shadow-lg"
                v-for="product in cart.cart"
                :key="product.id"
            >
                <div class="w-3/5 h-full">
                    <div class="p-2">
                        <span class="text-indigo-500 font-bold text-sm">{{
                            product.name
                        }}</span>
                    </div>
                    <div class="p-2">
                        <p class="text-indigo-500">
                            <small class="font-semibold">Quantity:</small>
                            <span class="font-bold text-base pl-1">
                                {{ product.quantity }}
                            </span>
                        </p>
                    </div>
                    <div class="p-2">
                        <p class="text-indigo-500">
                            <small class="font-semibold">Total:</small>
                            <span class="font-bold text-base pl-1"
                                >{{ total_amount(product) }} €</span
                            >
                        </p>
                    </div>
                    <div class="p-2">
                        <form @submit.stop.prevent="removeItem" class="w-full">
                            <button
                                type="submit"
                                class="
                                    text-white
                                    indigo-gradient-rounded
                                    font-bold
                                    text-xs
                                    p-2
                                    rounded-md
                                "
                                :data-item="product.id"
                                :data-item_number="product.product_number"
                            >
                                Remove from cart
                            </button>
                        </form>
                    </div>
                </div>
                <div class="w-2/5 h-full">
                    <img
                        :src="product.image_path"
                        class="w-full h-full object-cover rounded-r-lg"
                        :alt="product.name"
                    />
                </div>
            </article>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: {
        cart: Object,
    },
    computed: {
        total_amount_cart() {
            let total_amount = parseFloat(this.cart.total_amount_cart / 100);
            return total_amount?.toFixed(2) || "0.00";
        },
    },
    methods: {
        total_amount(product) {
            let total_amount = parseFloat(product.total_amount / 100);
            return total_amount?.toFixed(2) || "0.00";
        },
        placeOrder(event) {
            this.$inertia.post("dummyRoute", {
                onSuccess: () => {
                    console.log("Success");
                },
            });
        },
        removeItem(event) {
            let target = event.target.children[0];
            let id = target.dataset.item;
            let product_number = target.dataset.item_number;

            this.$inertia.post(route("cart.remove_item"), {
                id,
                product_number,
            });
        },
    },
});
</script>
