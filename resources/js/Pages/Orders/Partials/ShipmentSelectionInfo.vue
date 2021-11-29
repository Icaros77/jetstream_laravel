<template>
    <div
        class="flex justify-between p-1"
        :class="{ 'text-gray-100': isSelected, 'text-indigo-400': !isSelected }"
    >
        <span class="inline-flex justify-center items-center"
            >{{ attribute }}:</span
        >
        <span class="inline-flex justify-center items-center value">
            <slot />
        </span>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: ["attribute", "isSelected"],
});
</script>
