<template>
    <div class="w-4/5 flex justify-between relative">
        <span
            :class="{ active: status >= 1 }"
            class="
                flex-grow
                relative
                inline-flex
                justify-center
                items-center
                text-transparent
                loading-bar
            "
            data-content="Shipment"
            >Shipment</span
        >
        <span
            :class="{ active: status >= 2 }"
            class="
                flex-grow
                relative
                inline-flex
                justify-center
                items-center
                text-transparent
                loading-bar
            "
            data-content="Payment"
            >Payment</span
        >
        <span
            :class="{ active: status == 3 }"
            class="
                flex-grow
                relative
                inline-flex
                justify-center
                items-center
                loading-bar
                text-transparent
            "
            data-content="Confirm"
            >Confirm</span
        >
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    // status : 1: Shipment | 2: Payment | 3: Confirm
    props: ['status']
});
</script>

<style></style>
