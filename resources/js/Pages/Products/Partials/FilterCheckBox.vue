<template>
    <div>
        <input
            :id="'filter' + name"
            type="checkbox"
            class="rounded-md checked:bg-indigo-500 checked:border-transparent"
            :value="modelValue"
            @change="updateCheck"
        />
        <label :for="'filter' + name" class="ml-2 text-indigo-500">
            {{ name }}
        </label>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    emits: ['update:modelValue'],
    props: ['modelValue', 'name'],
    methods: {
        updateCheck(event) {
            this.$emit("update:modelValue", event.target.checked);
        }
    }
});
</script>
