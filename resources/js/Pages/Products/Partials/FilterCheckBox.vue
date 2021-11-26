<template>
    <div>
        <button
            @click.stop="switchToggle"
            type="button"
            class="px-3 py-1 border-2 bg-white border-white text-indigo-400 rounded-lg"
        >
            {{ name }}
        </button>
        <input
            type="checkbox"
            class="hidden"
            :value="modelValue"
            @change="updateCheck"
            ref="checkBox"
        />
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    emits: ["update:modelValue"],
    props: ["modelValue", "name"],
    methods: {
        updateCheck(event) {
            this.$emit("update:modelValue", event.target.checked);
        },
        switchToggle(event) {
            const target = event.target;
            target.classList.toggle("bg-white");
            target.classList.toggle("bg-transparent");
            target.classList.toggle("text-indigo-400");
            target.classList.toggle("text-white");
            this.$refs.checkBox.click();
        },
    },
});
</script>
