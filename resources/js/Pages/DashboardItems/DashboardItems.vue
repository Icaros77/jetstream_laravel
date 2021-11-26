<template>
    <article
        :index="index"
        v-for="(info, index) in mainInfo"
        :key="info.title"
        class="p-3 max-w-xs min-w-20 min-h-8 sm:min-w-15 sm:min-h-12 md:max-w-full md:w-1/3"
    >
        <div
            class="
                p-2
                flex
                w-full
                h-full
                bg-gradient-to-br
                from-gray-100
                to-indigo-200
                rounded-lg
                shadow-lg
                items-stretch
            "
        >
            <div class="flex flex-col flex-grow">
                <header class="w-max sm:h-12 sm:w-full">
                    <h2 class="text-indigo-400 p-1 font-bold sm:flex sm:max-h-full">
                        <span class="sm:flex-grow sm:p-1">{{ info.title }}</span>
                        <span
                            class="max-h-full justify-center items-center hidden sm:inline-block"
                        >
                            <img
                                :src="info.icon"
                                class="w-full h-full object-contain"
                        /></span>
                    </h2>
                </header>
                <p
                    class="
                        text-indigo-400
                        flex
                        self-end
                        justify-around
                        items-center
                        font-semibold
                        w-full
                        h-full
                    "
                >
                    <span v-if="info.special" class="inline-block text-3xl sm:text-5xl md:text-4xl lg:text-5xl">{{
                        info.special
                    }}</span>
                    <span class="text-4xl sm:text-5xl md:text-4xl lg:text-5xl"> {{ info.content }}</span>
                </p>
            </div>
            <div
                class="flex-grow flex justify-center items-center p-2 sm:hidden"
            >
                <span
                    class="inline-flex justify-center items-center"
                    style="max-width: 70px; max-height: 70px"
                >
                    <img
                        :src="info.icon"
                        class="w-full h-full object-contain"
                    />
                </span>
            </div>
        </div>
    </article>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    setup() {
        function today() {
            const today = new Date();
            return `${today.getFullYear()}/${today.getMonth()}/${today.getDate()}`;
        }
        return { today };
    },
    data() {
        return {
            mainInfo: [
                {
                    title: "Expenses this month",
                    content: "200",
                    special: "€",
                    icon: "images/money.png",
                },
                {
                    title: "Orders this month",
                    content: "14",
                    icon: "images/delivery.png",
                },
                {
                    title: "Last date order",
                    content: this.today(),
                    icon: "images/last_order.png",
                },
            ],
        };
    },
});
</script>
