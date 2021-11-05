<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div
                class="
                    max-w-7xl
                    p-5
                    mx-auto
                    sm:px-6
                    lg:px-8
                    bg-red-300
                    flex
                    flex-col
                    justify-between
                "
            >
                <display-items :products="products" />
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import DisplayItems from "./DisplayItems/DisplayItems.vue";

export default defineComponent({
    components: {
        AppLayout,
        Welcome,
        DisplayItems
    },
    props: {
        products: Object,
    },
});
</script>
