<template>
    <nav class="h-full flex flex-col">
        <div class="flex-grow w-full">
            <ul class="flex flex-wrap justify-around w-full p-8 px-12">
                <li class="width-48 max-w-xs/2 h-32 bg-gray-100 rounded-md">
                    <nav-link :href="route('products.index')">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-18 w-18 fill-current text-red-400"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span class="mt-3 text-gray-400 font-bold"
                            >Products</span
                        >
                    </nav-link>
                </li>
                <li class="width-48 max-w-xs/2 h-32 bg-gray-100 rounded-md">
                    <nav-link :href="route('products.index')">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-18 w-18 fill-current text-red-400"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span class="mt-3 text-gray-400 font-bold"
                            >Products</span
                        >
                    </nav-link>
                </li>
                <li
                    class="width-48 mt-4 max-w-xs/2 h-32 bg-gray-100 rounded-md"
                >
                    <nav-link :href="route('products.index')">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-18 w-18 fill-current text-red-400"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span class="mt-3 text-gray-400 font-bold"
                            >Products</span
                        >
                    </nav-link>
                </li>
            </ul>
        </div>
        <div class="flex-shrink">
            <span
                class="
                    block
                    w-11/12
                    mx-auto
                    h-1
                    rounded-full
                    bg-gradient-to-r
                    from-pink-100
                    to-indigo-100
                "
            ></span>
        </div>
        <div class="flex-shrink">
            <ul
                class="
                    flex flex-col
                    justify-center
                    items-center
                    w-full
                    p-8
                    px-12
                "
            >
                <li class="rounded-md w-full">
                    <jet-button
                        @click.stop="logout"
                        type="button"
                        classes="bg-gradient-to-br from-gray-100 via-pink-100 to-indigo-200 justify-center w-full font-bold text-indigo-400"
                        ><span class="mr-3">Logout</span
                        ><svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                            /></svg
                    ></jet-button>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
import { defineComponent } from "vue";
import NavLink from "./NavLink.vue";
import JetButton from "./Button.vue";
import store from "../Plugins/VuexStore";

export default defineComponent({
    components: { NavLink, JetButton },
    store: store,
    methods: {
        logout() {
            this.$store.dispatch("logoutUser");
        },
    },
});
</script>
