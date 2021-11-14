<template>
    <div
        class="
            max-w-7xl
            p-5
            mx-auto
            sm:px-6
            lg:px-8
            flex flex-wrap
            justify-center
            sm:justify-around
        "
    >
        <dashboard-items />
    </div>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import DashboardItems from "./DashboardItems/DashboardItems.vue";

export default defineComponent({
    components: {
        DashboardItems,
    },
    layout: AppLayout,
});
</script>
