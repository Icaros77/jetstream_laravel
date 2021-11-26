<template>
    <teleport to="body">
        <transition
            enter-active-class="ease-in duration-300"
            enter-from-class="translate-y-full sm:translate-y-0 sm:translate-x-full"
            enter-to-class="translate-y-0 sm:translate-y-0 sm:translate-x-0"
            leave-active-class="ease-in duration-300"
            leave-from-class="translate-y-0 sm:translate-x-0"
            leave-to-class="translate-y-full sm:translate-y-0 sm:translate-x-full"
        >
            <div
                v-show="show"
                class="
                    translate-y-full
                    transform
                    fixed
                    w-screen
                    inset-0
                    sm:translate-y-0
                    sm:inset-y-0 sm:left-0 sm:w-1/2
                    bg-gray-100
                    z-10
                "
            >
                <div class="flex justify-center flex-col w-full h-header">
                    <slot></slot>
                </div>
            </div>
        </transition>
    </teleport>
</template>

<script>
import { defineComponent, onMounted, onUnmounted } from "vue";
import store from "../Plugins/VuexStore";

export default defineComponent({
    store: store,

    computed: {
        show() {
            const showing = this.$store.getters["offsetHeader/getShow"];
            if (showing) document.body.style.overflow = "hidden";
            else document.body.style.overflow = "";
            return showing;
        },
    },
    created() {
        const closeable = (event) => {
            const showing = this.$store.getters["offsetHeader/getShow"];
            if (showing && event.key === "Escape") {
                this.$store.commit("offsetHeader/defaultMenu");
            }
        };
        onMounted(() => document.addEventListener("keydown", closeable));
        onUnmounted(() => {
            document.removeEventListener("keydown", closeable);
            document.body.style.overflow = null;
        });
    },
});
</script>
