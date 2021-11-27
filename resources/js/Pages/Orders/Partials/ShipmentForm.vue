<template>
    <div class="w-full flex justify-center items-center">
        <form @submit.stop.prevent="placeOrder"  class="w-full flex flex-col p-5">
            <label-name v-model="form.client_name">Name</label-name>
            <label-name name="email" v-model="form.client_email">Email</label-name>
            <label-name v-model="form.shipment_address">Ship. Address</label-name>
            <label-name v-model="form.shipment_postal_code">Ship. Postal code</label-name>
            <label-name v-model="form.shipment_city">Ship. City</label-name>
            <label-name v-model="form.shipment_country">Ship. Country</label-name>
            <div class="self-end mt-5 mr-5 w-max">
                <button type="submit" class="btn indigo-gradient-rounded text-white">
                    Confirm order!
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import LabelName from "@/components/FormElements/LabelName.vue";

export default defineComponent({
    components: { LabelName },
    props: ["user", "info"],
    data() {
        return {
            form: this.$inertia.form({
                client_name: this.user?.name || "",
                client_email: this.user?.email || "",
                shipment_address: this.info?.address || "",
                shipment_postal_code: this.info?.postal_code || "",
                shipment_city: this.info?.city || "",
                shipment_country: this.info?.country || "",
            }),
        }
    },
    methods: {
        placeOrder(event) {
            this.form.transform((data) => ({...data})).post(route("orders.store"));
        }
    }
});
</script>
