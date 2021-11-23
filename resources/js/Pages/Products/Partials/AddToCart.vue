<template>
    <button
        @click="this.$emit('addToCart')"
        type="button"
        class="
            w-3/5
            text-white
            indigo-gradient-rounded
            font-bold
            text-xs
            p-2
            rounded-md
        "
    >
        Add to cart
    </button>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    emits: ['addToCart'],
})
</script>

