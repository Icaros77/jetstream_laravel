<template>
    <button
        @click="this.$emit('addToCart')"
        type="button"
        class="
            w-3/5
            text-white
            bg-gradient-to-br
            from-indigo-300
            to-indigo-500
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

