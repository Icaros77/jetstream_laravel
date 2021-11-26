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
                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
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
        Link,
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
            this.$store.commit("offsetHeader/defaultMenu");
        },
        ...mapMutations("offsetHeader", ["toggleMenu"]),
    },
});
</script>
