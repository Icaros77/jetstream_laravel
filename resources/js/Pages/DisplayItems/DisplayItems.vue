<template>
    <div
        :class="{'rounded-tr-full' : !index, 'rounded-tl-full': index}"
        class="
            p-3
            pt-0
            rounded-md
            mb-12
            bg-gradient-to-br
            from-indigo-300
            via-indigo-400
            to-indigo-500
        "
        v-for="(list, category) in products"
        :key="category"
    >
        <header class="flex">
            <h3
                class="
                    w-1/3
                    p-2
                    font-bold
                    italic
                    rounded-t-md
                    text-indigo-600 text-center
                "
                :class="{ 'order-2': moveTo() }"
            >
                {{ toCapitalize(category) }}
            </h3>
            <span
                :class="{
                    'order-1': index,
                    'rounded-bl-md': index,
                    'rounded-br-md': !index,
                }"
                class="w-2/3 inline-block p-2 min-h-full bg-red-300"
            ></span>
        </header>
        <div
            class="flex max-w-full overflow-x-scroll rounded-t-md space-x-8 p-8"
            :class="{ 'flex-row-reverse': !index }"
        >
            <div
                class="
                    min-w-10
                    max-w-xs/2
                    sm:min-w-2/5
                    md:w-60 md:min-w-10
                    bg-gray-100
                    rounded-lg
                "
                v-for="item in list"
                :key="item.id"
            >
                <div class="rounded-t-lg">
                    <img
                        class="
                            w-full
                            h-full
                            object-center object-cover
                            rounded-t-lg
                        "
                        :src="item.image_path"
                    />
                </div>
                <div class="flex flex-col p-2 items-stretch">
                    <span class="text-gray-600 font-semibold">{{
                        item.name
                    }}</span>
                    <span class="text-gray-600 font-semibold self-end"
                        >{{ item.price }} €</span
                    >
                </div>
            </div>
        </div>
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
        products: {
            type: Object,
        },
    },

    data() {
        return {
            index: 0,
        };
    },
    methods: {
        toCapitalize(string) {
            let firstChar = string.charAt(0).toUpperCase();
            let restChars = string.slice(1);
            return firstChar + restChars;
        },
        moveTo() {
            if (this.index) {
                this.index = 0;
                return true;
            }
            this.index = 1;
            return false;
        },
    },
});
</script>
