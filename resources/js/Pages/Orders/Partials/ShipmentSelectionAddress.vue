<template>
    <div
        class="p-3 relative"
        :class="{ 'indigo-gradient-rounded': isSelected, 'bg-transparent': !isSelected }"
    >
        <span
            @click="selectAddress"
            class="absolute w-full h-full top-0 left-0"
        ></span>
        <header class="w-max">
            <h3
                class="font-semibold"
                :class="{
                    'text-gray-100': isSelected,
                    'text-indigo-400': !isSelected,
                }"
            >
                Address #{{ index + 1 }}
            </h3>
        </header>
        <div class="w-full flex flex-col">
            <shipment-selection-info :isSelected="isSelected" attribute="Address">
                {{ info.address }}
            </shipment-selection-info>
            <shipment-selection-info :isSelected="isSelected" attribute="Postal code">
                {{ info.postal_code }}
            </shipment-selection-info>
            <shipment-selection-info :isSelected="isSelected" attribute="City">
                {{ info.city }}
            </shipment-selection-info>
            <shipment-selection-info :isSelected="isSelected" attribute="Country">
                {{ info.country }}
            </shipment-selection-info>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import ShipmentSelectionInfo from "./ShipmentSelectionInfo.vue";
export default defineComponent({
    emits: ["updateForm"],
    components: { ShipmentSelectionInfo },
    props: ["index", "info", "activeAddress"],
    data() {
        return {
            active: this.info.id,
        };
    },
    computed: {
        isSelected() {
            return this.active === this.activeAddress;
        },
    },
    methods: {
        selectAddress(event) {
            const parent = event.target.parentElement;
            let [
                shipment_address,
                shipment_postal_code,
                shipment_city,
                shipment_country,
            ] = parent.querySelectorAll(".active .value");

            let data = {
                shipment_address,
                shipment_postal_code,
                shipment_city,
                shipment_country,
                active_address: this.active
            };

            this.$emit("updateForm", data);
        },
    },
});
</script>

<style></style>
