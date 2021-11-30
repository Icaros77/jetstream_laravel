<template>
    <div class="w-full flex justify-center items-center">
        <form @submit.stop.prevent="createAddress"  class="w-full flex flex-col p-5">
            <label-name :first="true" v-model="form.shipment_address">Ship. Address</label-name>
            <label-name v-model="form.shipment_postal_code">Ship. Postal code</label-name>
            <label-name v-model="form.shipment_city">Ship. City</label-name>
            <label-name v-model="form.shipment_country">Ship. Country</label-name>
            <div class="self-center flex justify-center mt-5 w-max">
                <button type="submit" class="btn red-gradient-rounded text-white">
                    Add Payment Method!
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
    props: ["info"],
    data() {
        return {
            form: this.$inertia.form({
                shipment_address: "",
                shipment_postal_code: "",
                shipment_city: "",
                shipment_country: "",
            }),
        }
    },
    methods: {
        createAddress() {
            this.form.transform((data) => ({...data})).post(route("infos.store"));
        }
    }
});
</script>
