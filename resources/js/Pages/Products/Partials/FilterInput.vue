<template>
    <div class="flex justify-between">
        <input
            @input="updateFilter"
            @focus.stop="filterFocus"
            type="text"
            class="
                flex-grow
                p-2
                pl-4
                bg-transparent
                border-0
                focus:ring-0
                text-indigo-500
            "
            placeholder="Search..."
            :value="modelValue"
        />
        <button
            ref="submit_filter"
            type="submit"
            class="btn rounded-none"
            :disabled="processing"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 fill-current text-indigo-500"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    emits: ["update:modelValue", "filterFocus"],
    props: {
        modelValue: String,
        processing: Boolean,
    },
    methods: {
        updateFilter(event) {
            if (event.key === "Enter" || event.key === 13) {
                this.$refs.submit_filter.click();
                return;
            }
            this.$emit("update:modelValue", event.target.value);
        },
        filterFocus() {
            this.$emit("filterFocus");
        },
    },
});
</script>
