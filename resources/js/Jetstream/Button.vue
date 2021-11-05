<template>
    <button
        :type="type"
        class="btn"
        :class="classes"
    >
        <slot></slot>
    </button>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: {
        type: {
            type: String,
            default: "submit",
        },
        adds: {
            type: Boolean,
            default: false,
        },
        subtract: {
            type: Boolean,
            default: false,
        },
        classes: {
            type: String,
        }
    },
});
</script>
