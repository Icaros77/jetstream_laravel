<template>
    <div
        class="
            w-full
            max-w-md
            bg-gradient-to-br
            from-indigo-300
            to-indigo-500
            flex flex-col
            justify-center
            items-center
            rounded-lg
            min-h-1/4
        "
    >
        <div class="p-4">
            <span class="font-semibold text-white">Your cart is empty!</span>
        </div>
        <div class="p-4">
            <Link
                :href="route('products.index')"
                class="font-bold text-white underline uppercase"
                >Purchase new stuff!!</Link
            >
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    setup() {},
    components: {
        Link,
    },
});
</script>
