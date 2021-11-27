<template>
    <dashboard-card
        :index="index"
        v-for="(info, index) in mainInfo"
        :key="index"
        :info="info"
    />
</template>

<script>
import { defineComponent } from "vue";
import DashboardCard from "./DashboardCard.vue";

export default defineComponent({
    components: { DashboardCard },
    props: ["orders", "user"],
    setup(props) {
        let orders = props.orders;
        const orders_months = orders.length;

        let expenses = orders.reduce((initial_value, order) => {
            return (initial_value += initial_value + order.total_amount_cart);
        }, 0);

        expenses = parseFloat(expenses / 100).toFixed(2);

        let last_order = orders[orders.length - 1].created_at;

        return {
            expenses,
            last_order,
            orders_months,
        };
    },
    data() {
        return {
            mainInfo: [
                {
                    title: "Expenses this month",
                    content: this.expenses,
                    special: "€",
                    icon: "images/money.png",
                },
                {
                    title: "Orders this month",
                    content: this.orders_months,
                    icon: "images/delivery.png",
                },
                {
                    title: "Last date order",
                    content: this.last_order,
                    icon: "images/last_order.png",
                },
            ],
        };
    },
    methods: {},
});
</script>
