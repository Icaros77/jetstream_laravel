<template>
    <div
        @click="select"
        :class="{ 'bg-red-400': buttonActive }"
        class="flex-1 flex justify-center transition duration-300"
    >
        <button type="button" class="p-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                :class="{
                    'text-red-400': !buttonActive,
                    'text-gray-100': buttonActive,
                }"
                class="h-16 w-16 fill-current"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                />
            </svg>
        </button>
    </div>
</template>

\
<script>
import { defineComponent } from "vue";
import { mapMutations } from "vuex";
import store from "../../Plugins/VuexStore";

export default defineComponent({
    emits: ["select"],
    store: store,
    props: {
        buttonActive: {
            default: false,
        },
        nameButton: { default: "Cart" },
    },
    methods: {
        select() {
            this.$emit("select", this.nameButton);
            this.toggleMenu({nameButton: this.nameButton});
        },
        ...mapMutations("offsetHeader", ["toggleMenu"]),
    },
});
</script>
