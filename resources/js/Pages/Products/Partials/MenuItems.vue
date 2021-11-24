<template>
    <div
        class="
            w-full
            sm:w-2/5
            mb-5
            bg-gray-100
            rounded-md
            shadow-lg
        "
        v-for="item in products.data"
        :key="item.id"
    >
        <div class="w-full flex sm:block">
            <div
                class="
                    w-1/3
                    sm:w-full sm:h-40 sm:rounded-t-md sm:rounded-b-none
                    rounded-md
                    product-container
                    sm:relative
                    overflow-hidden
                "
            >
                <img
                    :src="item.image_path"
                    class="
                        w-full
                        h-full
                        object-center object-cover
                        sm:rounded-t-md sm:rounded-b-none
                        rounded-md
                    "
                    :alt="item.name"
                />
                <div
                    :class="slidingFrom"
                    class="
                        hidden
                        absolute
                        inset-0
                        bg-yellow-700 bg-opacity-40
                        sm:flex
                        flex-column
                        transform transform-gpu
                        product-description
                        transition-transform
                    "
                >
                    <p
                        class="
                            text-white
                            w-full
                            font-bold
                            flex-stretch flex
                            justify-center
                            items-center
                        "
                        style="padding: 5%"
                    >
                        {{ item.description }}
                    </p>
                </div>
            </div>
            <div class="w-2/3 sm:w-full p-3 pb-0 flex flex-col justify-around">
                <p class="px-5 pb-5 flex justify-around">
                    <span class="text-indigo-500 font-semibold">{{
                        item.name
                    }}</span>
                    <span class="text-indigo-500 font-semibold"
                        >{{ parsePrice(item) }} €</span
                    >
                </p>
                <menu-item-counter :item="item" :cart="cart" />
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import MenuItemCounter from "./MenuItemCounter.vue";

export default defineComponent({
    components: {
        MenuItemCounter,
    },
    props: ["products", "cart"],
    data() {
        return {
            // true => right, false => left
            slideFrom: true,
        };
    },
    computed: {
        slidingFrom() {
            if (this.slideFrom) {
                this.slideFrom = false;
                return {
                    "-translate-x-full": true,
                    "translate-x-full": false,
                };
            }
            this.slideFrom = true;
            return {
                "-translate-x-full": false,
                "translate-x-full": true,
            };
        },
    },

    methods: {
        parsePrice(item) {
            return parseFloat(item.price / 100).toFixed(2);
        },
    },
});
</script>
