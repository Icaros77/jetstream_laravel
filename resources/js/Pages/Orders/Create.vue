<template>
    <div class="flex flex-col space-y-5 justify-center items-center">
        <order-progress-bar :status="progress[panel]" />
        <panel-shipment
            v-if="progress[panel] === 1"
            @changePanel="changePanel"
            @updateForm="updateForm"
            :infos="info"
            :user="user"
            :activeAddress="form.active_address"
        />

        <panel-payment
            v-if="progress[panel] === 2"
            @changePanel="changePanel"
            :payment_methods="payment_methods"
            :payment_infos="payment_infos"
        />
        <div class="self-start">
            <Link :href="route('cart.index')" class="btn red-gradient-rounded">
                Cancel order
            </Link>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PanelShipment from "./Partials/PanelShipment.vue";
import PanelPayment from "./Partials/PanelPayment.vue";
import OrderProgressBar from "./Partials/OrderProgressBar.vue";

export default defineComponent({
    setup(props) {
        const positionbar = function () {
            if (props.payment_infos?.length > 0) return "confirm";
            if (props.info?.length > 0) return "payment";
            return "shipment";
        };

        const defaultInfo =  Object.values(props.info || []).find(
            (info) => info.default
        );

        return { positionbar, defaultInfo };
    },

    components: { PanelShipment, PanelPayment, OrderProgressBar, Link },
    layout: AppLayout,
    props: ["user", "info", "payment_methods", "payment_infos"],
    data() {
        return {
            panel: this.positionbar(),
            progress: {
                shipment: 1,
                payment: 2,
                confirm: 3,
            },
            form: this.$inertia.form({
                client_name: this.user?.name || "",
                client_email: this.user?.email || "",
                shipment_address: this.defaultInfo?.address || "",
                shipment_postal_code: this.defaultInfo?.postal_code || "",
                shipment_city: this.defaultInfo?.city || "",
                shipment_country: this.defaultInfo?.country || "",
                active_address: this.defaultInfo?.id,
            }),
        };
    },
    methods: {
        changePanel(event) {
            this.panel = event.target.dataset.panel;
        },
        updateForm(data) {
            data.active_address ||
                (data.active_address = this.form.active_address);
            this.form = data;
        },
    },
});
</script>
