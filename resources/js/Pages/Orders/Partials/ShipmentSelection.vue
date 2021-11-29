<template>
    <div
        v-for="(info, index) in infos"
        :key="info.id"
        class="
            w-4/5
            p-1
            cursor-pointer
            rounded-lg
            bg-gray-100
            border-2 border-indigo-400
        "
    >
        <shipment-address
            :index="index"
            :info="info"
            :activeAddress="activeAddress"
            @updateForm="updateForm"
        />
    </div>
    <div>
        <button
            @click.stop="openShipmentForm"
            type="button"
            class="btn indigo-gradient-rounded text-gray-100"
        >
            Add new Address
        </button>
    </div>
    <shipment-form v-show="openForm" />
</template>

<script>
import { defineComponent } from "vue";
import ShipmentForm from "./ShipmentFormDB.vue";
import ShipmentAddress from "./ShipmentSelectionAddress.vue";

export default defineComponent({
    emits: ["updateForm"],
    components: { ShipmentForm, ShipmentAddress },
    props: ["infos", "activeAddress"],

    data() {
        return {
            openForm: false,
        };
    },
    methods: {
        openShipmentForm() {
            this.openForm = !this.openForm;
        },
        updateForm(data) {
            this.$emit("updateForm", data);
        },
    },
});
</script>
