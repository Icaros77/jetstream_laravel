<template>
    <div :class="{'mt-10' : !first}" class="p-2 w-full relative">
        <span
            @click.stop="selectInput"
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
        <span
            v-if="type === 'password'"
            class="
                transform
                -translate-x-7
                absolute
                h-full
                inline-flex
                justify-center
                items-center
                top-0
                right-0
            "
            @click="showPassword"
        >
            <svg
                v-show="isHiding"
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 fill-current text-indigo-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                <path
                    fill-rule="evenodd"
                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                    clip-rule="evenodd"
                />
            </svg>
            <svg
                v-show="!isHiding"
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 fill-current text-indigo-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                    clip-rule="evenodd"
                />
                <path
                    d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"
                />
            </svg>
        </span>
        <input
            :type="type"
            class="
                py-2
                px-4
                w-full
                border-indigo-400
                focus:ring-indigo-600
                focus:ring-2
                focus:ring-offset-0
                focus:border-0
                rounded-full
            "
            @focus="isFocused"
            @blur="lostFocus"
            @input="isChanging"
            autocomplete="off"
            ref="input"
            :value="modelValue"
            required
        />
    </div>
    <input-error :type="type" :errorBag="errorBag" />
</template>

<script>
import { defineComponent } from "vue";
import InputError from "./InputError.vue";

export default defineComponent({
    emits: ["update:modelValue"],
    components: {
        InputError,
    },
    props: {
        type: {
            tpye: String,
            default: "text",
        },
        modelValue: String,
        errorBag: String,
        first: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            status: false,
            isHiding: true,
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
            const target = this.$refs.input;
            let value = target.value;
            if (document.activeElement == target) {
                this.status = true;
            } else {
                this.status = value ? true : false;
            }
            this.$emit("update:modelValue", value);
        },
        isFocused(event) {
            if (event.target.value) return;
            this.status = true;
        },
        lostFocus(event) {
            if (event.target.value) return;
            this.status = false;
        },
        showPassword() {
            this.$refs.input.type = !this.isHiding ? "password" : "text";
            this.isHiding = !this.isHiding;
        },
        selectInput() {
            this.$refs.input.focus();
        },
    },
});
</script>
