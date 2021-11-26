<template>
    <div
        @click="select"
        :class="{ 'bg-indigo-400': buttonActive }"
        class="transition flex-1 flex justify-center duration-300"
    >
        <Link :href="route('dashboard')" class="p-2 inline-block">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-16 w-16 fill-current"
                :class="{
                    'text-indigo-400': !buttonActive,
                    'text-gray-100': buttonActive,
                }"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                />
            </svg>
        </Link>
    </div>
</template>

\
<script>
import { defineComponent } from "vue";
import { mapMutations } from "vuex";
import store from "../../Plugins/VuexStore";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    emits: ["select"],
    components: {
        Link
    },
    store: store,
    props: {
        buttonActive: {
            default: false,
        },
        nameButton: { default: "Home" },
    },
    methods: {
        select() {
            this.$emit("select", this.nameButton);
            this.$store.commit('offsetHeader/defaultMenu');
        },
        ...mapMutations("offsetHeader", ["toggleMenu"]),
    },
});
</script>
