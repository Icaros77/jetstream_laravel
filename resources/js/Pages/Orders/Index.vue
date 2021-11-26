<template>
    <div class="flex justify-center items-center">
        <order-items :orders="orders"/>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import OrderItems from "./Partials/OrderItems.vue";

export default defineComponent({
    components: { OrderItems },
    layout: AppLayout,
    props: ["orders"],
});
</script>
