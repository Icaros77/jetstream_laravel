<template>
    <div
        class="
            w-full
            max-w-md
            indigo-gradient-rounded
            flex flex-col
            justify-center
            items-center
            min-h-1/4
            shadow-lg
        "
    >
        <div class="p-4">
            <span class="font-semibold text-white">Your cart is empty!</span>
        </div>
        <div class="p-4">
            <Link
                :href="route('products.index')"
                class="font-bold text-white underline uppercase"
            >
                Purchase new stuff!!
            </Link>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Link,
    },
});
</script>
