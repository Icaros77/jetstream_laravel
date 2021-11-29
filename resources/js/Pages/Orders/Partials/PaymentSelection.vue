<template>
    <div>
        <div v-for="method in payment_methods" :key="method.id">
            <method :method="method" />
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import Method from "./PaymentMethod.vue";

export default defineComponent({
    components: { Method },
    props: ["payment_methods", "payment_infos"],
})
</script>
