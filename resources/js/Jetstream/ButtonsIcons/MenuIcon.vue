<template>
    <div
        @click="select"
        :class="{ 'bg-red-400': buttonActive }"
        class="transition duration-300 flex-1 flex justify-center"
    >
        <button type="button" class="p-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-16 w-16 fill-current"
                :class="{
                    'text-red-400': !buttonActive,
                    'text-gray-100': buttonActive,
                }"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="M4 6h16M4 12h16m-7 6h7"
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
    created() {
        this.defaultMenu();
    },
    emits: ["select", "open-side-menu"],
    store: store,

    props: {
        buttonActive: {
            default: false,
        },
        nameButton: { default: "Menu" },
    },
    methods: {
        select() {
            this.$emit("select", this.nameButton);
            this.toggleMenu({
                nameButton: this.nameButton,
                buttonActive: this.buttonActive,
            });
        },
        ...mapMutations("offsetHeader", ["toggleMenu"]),
        ...mapMutations("offsetHeader", ["defaultMenu"]),
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
