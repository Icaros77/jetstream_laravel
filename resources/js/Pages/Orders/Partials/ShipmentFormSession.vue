<template>
    <div class="w-full flex flex-col p-5 justify-center items-center">
        <label-name @update:modelValue="updateForm" v-model="form.client_name">Name</label-name>
        <label-name @update:modelValue="updateForm" name="email" v-model="form.client_email">Email</label-name>
        <label-name @update:modelValue="updateForm" v-model="form.shipment_address">Ship. Address</label-name>
        <label-name @update:modelValue="updateForm" v-model="form.shipment_postal_code"
            >Ship. Postal code</label-name
        >
        <label-name @update:modelValue="updateForm" v-model="form.shipment_city">Ship. City</label-name>
        <label-name @update:modelValue="updateForm" v-model="form.shipment_country">Ship. Country</label-name>

    </div>
</template>

<script>
import { defineComponent } from "vue";
import LabelName from "@/components/FormElements/LabelName.vue";

export default defineComponent({
    emits: ["updateForm"],
    components: { LabelName },
    data() {
        return {
            form: {
                client_name: "",
                client_email: "",
                shipment_address: "",
                shipment_postal_code: "",
                shipment_city: "",
                shipment_country: "",
            },
        };
    },
    methods: {
        updateForm() {
            this.$emit("updateForm", this.form);
        }
    },
});
</script>
