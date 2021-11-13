<template>
    <app-layout title="Products">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div
                class="
                    max-w-7xl
                    p-5
                    mx-auto
                    sm:px-6
                    lg:px-8
                    bg-red-300
                    flex flex-wrap
                    justify-between
                    sm:justify-around
                "
            >
                <menu-items />
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import MenuItems from "./Partials/MenuItems.vue";

export default defineComponent({
    components: {
        AppLayout,
        MenuItems,
    },
});
</script>
