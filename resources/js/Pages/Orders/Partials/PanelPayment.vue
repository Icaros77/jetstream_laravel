<template>
    <div class="w-full flex flex-col px-2">
        <payment-selection :payment_methods="payment_methods" />
        <div class="flex justify-between">
            <button
                @click="moveTo"
                data-panel="shipment"
                type="button"
                class="btn indigo-gradient-rounded"
            >
                <svg
                    data-panel="shipment"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 fill-current text-white"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
                <span data-panel="shipment">Shipment</span>
            </button>
            <button
                @click="moveTo"
                data-panel="confirm"
                type="button"
                class="btn indigo-gradient-rounded"
            >
                <span data-panel="confirm">Confirm</span>
                <svg
                    data-panel="confirm"
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
    </div>
</template>

<script>
import { defineComponent } from "vue";
import PaymentSelection from "./PaymentSelection.vue";

export default defineComponent({
    emits: ["changePanel"],
    components: { PaymentSelection },
    props: ["payment_methods"],

    methods: {
        moveTo(event) {
            this.$emit("changePanel", event);
        },
    },
});
</script>
