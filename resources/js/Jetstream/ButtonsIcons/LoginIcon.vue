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
                    fill-rule="evenodd"
                    d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>
    </div>
</template>

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
        nameButton: { default: "Login" },
    },
    methods: {
        select() {
            this.$emit("select", this.nameButton);
            this.toggleMenu({
                nameButton: this.nameButton,
                buttonActive: this.buttonActive
            });
        },
        ...mapMutations("offsetHeader", ["toggleMenu"]),
    },
    created() {
        const unselectMenu = (event) => {
            const showing = this.$store.getters["offsetHeader/getShow"];
            if (showing && event.key === "Escape") {
                this.$emit("select", this.nameButton);
            }
        };
        document.addEventListener("keydown", unselectMenu);
    },
});
</script>
