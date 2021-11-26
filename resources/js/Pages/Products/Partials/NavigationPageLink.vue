<template>
    <li
        class="
            w-1/5
            text-white
            font-bold
            indigo-gradient-rounded
            rounded-md
            shadow-lg
            hover:from-indigo-500 hover:to-indigo-700
        "
        style="max-width: 80px"
        :class="isActive"
    >
        <Link
            :href="url"
            class="flex w-full h-full justify-center items-center px-3 py-2"
        >
            {{ page_number }}
        </Link>
    </li>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: { Link },
    props: ["page_number", "url", "active"],
    computed: {
        isActive() {
            return this.active ? "from-indigo-500 to-indigo-700" : "";
        },
    },
});
</script>
