<template>
    <li
        v-if="condition"
        class="
            w-1/5
            text-white
            font-bold
            bg-gradient-to-br
            from-indigo-300
            to-indigo-400
            rounded-md
            shadow-lg
        "
    >
        <Link :href="queryBuilder" class="flex w-full h-full justify-center items-center">
            {{ page_number }}
        </Link>
    </li>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: { Link },
    props: ["page_number", "condition", "path"],
    computed: {
        queryBuilder() {
            return `${this.path}?page=${this.page_number}`;
        },
    },
});
</script>
