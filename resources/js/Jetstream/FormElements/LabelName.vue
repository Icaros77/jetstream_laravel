<template>
    <span
        :class="slidesUpDown"
        class="
            absolute
            transform transform-gpu
            transition-all
            duration-300
            translate-x-7
            h-full
            inline-flex
            justify-center
            items-center
            top-0
            left-0
        "
    >
        <slot />
    </span>
    <input
        :type="type"
        class="
            py-2
            px-4
            w-full
            border-indigo-400
            focus:ring-indigo-600
            rounded-full
        "
        @focus="isFocused"
        @blur="lostFocus"
        @input="isChanging"
    />
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: {
        type: {
            tpye: String,
            default: "text",
        },
    },
    data() {
        return {
            status: false,
        };
    },
    computed: {
        slidesUpDown() {
            return this.status
                ? "-translate-y-2/3 text-base text-indigo-500 font-bold translate-x-5"
                : "translate-y-0 text-xs text-indigo-400";
        },
    },
    methods: {
        isChanging(event) {
            let currentStatus = event.target.value ? true : false;
            if (document.activeElement == event.target) {
                this.status = true;
            } else {
                this.status = currentStatus;
            }
        },

        isFocused(event) {
            if (event.target.value) return;
            this.status = true;
        },
        lostFocus(event) {
            if (event.target.value) return;
            this.status = false;
        },
    },
    setup() {},
});
</script>
