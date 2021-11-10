<template>
    <article class="flex p-5" v-for="product in products" :key="product.id">
        <div>{{ product.name }}</div>
    </article>
</template>

<script>
import { defineComponent } from "vue";
import AppLayoutVue from "../../Layouts/AppLayout.vue";
import store from "../../Plugins/VuexStore";

export default defineComponent({
    setup() {},
    props:{
        products: {
            type: Boolean
        }
    },
    store: store,
    layout: AppLayoutVue
});
</script>
