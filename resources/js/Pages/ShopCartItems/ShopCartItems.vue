<template>
    <article class="flex p-5" v-for="product in products" :key="product.id">
        <div>{{ product.name }}</div>
    </article>
</template>

<script>
import { defineComponent } from "vue";
import AppLayoutVue from "../../Layouts/AppLayout.vue";
import store from "../../Plugins/VuexStore";
import { mapGetters } from "vuex";

export default defineComponent({
    setup() {},
    store: store,
    layout: AppLayoutVue,
    computed: {
        products() {
            return this.getCart.products;
        },
    },
    methods: {
        ...mapGetters["getCart"],
    },
});
</script>
