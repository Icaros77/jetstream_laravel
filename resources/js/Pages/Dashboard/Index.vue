<template>
    <Head title="Dashboard" />
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
        <dashboard-items v-if="hasOrders" :orders="orders" :user="user" />
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import DashboardItems from "./Partials/DashboardItems.vue";

export default defineComponent({
    components: {
        DashboardItems,
        Head,
    },
    props: ["orders", "user"],
    layout: AppLayout,
    computed: {
        hasOrders() {
            return this.orders?.length > 0;
        }
    }
});
</script>
