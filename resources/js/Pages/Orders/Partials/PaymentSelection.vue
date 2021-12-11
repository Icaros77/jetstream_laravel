<template>
    <div v-for="method in payment_methods" :key="method.id">
        <method :method="method.method" />
    </div>
</template>

<script>
import { defineComponent } from "vue";
import Method from "./PaymentMethod.vue";

export default defineComponent({
    components: { Method },
    setup(props) {
        console.log(props.payment_methods);
    },
    props: ["payment_methods", "payment_infos"],
});
</script>
