<template>
    <template v-if="hasUser && hasInfos">
        <shipment-selection :activeAddress="activeAddress" :infos="infos" @updateForm="updateForm" />
        <div class="self-end">
            <button
                @click.stop="moveTo"
                data-panel="payment"
                class="btn indigo-gradient-rounded"
            >
                <span data-panel="payment">Payment</span>
                <svg
                    data-panel="payment"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 fill-current text-white"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
            </button>
        </div>
    </template>

    <template v-else-if="hasUser">
        <shipment-form />
    </template>

    <template v-else>
        <shipment-form-session @updateForm="updateForm" />
    </template>

</template>

<script>
import { defineComponent } from "vue";
import ShipmentForm from "./ShipmentFormDB.vue";
import ShipmentFormSession from "./ShipmentFormSession.vue";
import ShipmentSelection from "./ShipmentSelection.vue";

export default defineComponent({
    emits: ["changePanel", "updateForm"],
    components: { ShipmentFormSession, ShipmentSelection, ShipmentForm },
    props: ["infos", "user", "activeAddress"],
    computed: {
        hasUser() {
            return this.user;
        },
        hasInfos() {
            return this.infos?.length > 0;
        }
    },
    methods: {
        moveTo(event) {
            this.$emit("changePanel", event);
        },
        updateForm(data) {
            this.$emit("updateForm", data);
        }
    },
});
</script>
