<template>
    <section class="w-full flex flex-wrap justify-center p-4">
        <article
            class="w-full mb-4 flex max-h-full flex-col rounded-lg shadow-lg"
            v-for="order in orders"
            :key="order.id"
        >
            <header class="rounded-lg p-4 bg-gray-200">
                <h4 class="flex flex-col justify-around">
                    <div class="p-3 flex justify-between">
                        <small class="text-gray-500 font-semibold"
                            >Order Number:</small
                        >
                        <span class="text-indigo-400 text-bold">
                            #{{ order.order_number }}
                        </span>
                    </div>
                    <div class="p-3 flex justify-between">
                        <small class="text-gray-500 font-semibold"
                            >Total amount:</small
                        >
                        <span class="text-indigo-400 text-bold">
                            {{ renderAmount(order.total_amount_cart) }} €
                        </span>
                    </div>
                </h4>
            </header>
            <section class="flex flex-col w-full h-44 p-4 overflow-y-scroll">
                <article
                    class="w-full py-4"
                    :class="{'border-b border-indigo-600' : order.cart.length > 1}"
                    v-for="product in order.cart"
                    :key="product.id"
                >
                    <div class="flex flex-col">
                        <div class="text-indigo-500 font-bold p-3">
                            {{ product.name }}
                        </div>
                        <div class="p-2 flex justify-between w-max">
                            <small
                                class="
                                    text-gray-400
                                    inline-flex
                                    items-center
                                    justify-center
                                "
                                >Quantity</small
                            >
                            <span
                                class="
                                    pl-2
                                    text-indigo-400
                                    inline-flex
                                    items-center
                                    justify-center
                                "
                                >{{ product.quantity }}</span
                            >
                        </div>
                        <div class="p-2 flex justify-between w-max">
                            <small
                                class="
                                    text-gray-400
                                    inline-flex
                                    items-center
                                    justify-center
                                "
                                >Total amount</small
                            >
                            <span
                                class="
                                    pl-2
                                    text-indigo-400
                                    inline-flex
                                    items-center
                                    justify-center
                                "
                                >{{ renderAmount(product.total_amount) }} €</span
                            >
                        </div>
                    </div>
                </article>
            </section>
            <div class="p-4 rounded-lg bg-gray-200">
                <div class="p-3 flex justify-between">
                    <small class="text-gray-500 font-semibold"
                        >Date of purchase</small
                    >
                    <span class="text-indigo-400 text-bold">
                        {{ order.created_at }}
                    </span>
                </div>
            </div>
        </article>
    </section>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default defineComponent({
    props: ["orders"],
    layout: AppLayout,
    methods: {
        renderAmount(total_amount_cart) {
            return parseFloat(total_amount_cart / 100).toFixed(2);
        },
    },
});
</script>
