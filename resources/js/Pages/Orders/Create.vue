<template>
    <div class="flex justify-center items-center">
        <shipment-form :user="user" />
    </div>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import ShipmentForm from "./Partials/ShipmentForm.vue";

export default defineComponent({
    components: { ShipmentForm },
    layout: AppLayout,
    props: ["user"],
});
</script>
