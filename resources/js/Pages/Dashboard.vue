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
                    flex-wrap
                    justify-center
                    sm:justify-around
                "
            >
            <dashboard-items />
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import DisplayItems from "./DisplayItems/DisplayItems.vue";
import DashboardItems from "./DashboardItems/DashboardItems.vue";

export default defineComponent({
    components: {
        AppLayout,
        Welcome,
        DashboardItems
    },
    props: {
        products: Object,
    },
});
</script>
