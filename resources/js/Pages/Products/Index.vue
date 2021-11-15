<template>
    <div
        class="
            max-w-7xl
            p-5
            mx-auto
            sm:px-6
            lg:px-8
            flex flex-wrap
            justify-between
            sm:justify-around
        "
    >
        <menu-items />
    </div>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import MenuItems from "./Partials/MenuItems.vue";

export default defineComponent({
    components: {
        MenuItems,
    },
    layout: AppLayout,
});
</script>
