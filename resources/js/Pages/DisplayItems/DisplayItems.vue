<template>
    <div class="p-3" v-for="(list, category) in products" :key="category">
        <h3 :class="{ 'text-right': moveTo() }" class="mb-3 p-2 text-gray-900">
            {{ toCapitalize(category) }}
        </h3>
        <div
            class="flex max-w-full overflow-x-scroll
             space-x-8 py-8"
            :class="{ 'justify-end': !index }"
        >
            <div
                class="min-w-10 max-w-xs/2 sm:min-w-2/5 md:w-60 md:min-w-10 bg-gray-100 rounded-lg shadow-lg"
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
