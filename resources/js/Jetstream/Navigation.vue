<template>
    <nav class="h-full flex flex-col">
        <div class="flex-grow w-full">
            <ul class="flex flex-wrap justify-around w-full p-8 px-12">
                <li
                    @click.stop="closeMenu"
                    class="width-48 max-w-xs/2 h-32 bg-gray-100 rounded-md shadow-lg"
                >
                    <nav-link :href="route('products.index')">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-18 w-18 fill-current text-indigo-400"
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
                    @click.stop="closeMenu"
                    class="width-48 max-w-xs/2 h-32 bg-gray-100 rounded-md shadow-lg"
                >
                    <nav-link :href="route('products.index')">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-18 w-18 fill-current text-indigo-400"
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
                    @click.stop="closeMenu"
                    class="width-48 mt-4 max-w-xs/2 h-32 bg-gray-100 rounded-md shadow-lg"
                >
                    <nav-link :href="route('products.index')">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-18 w-18 fill-current text-indigo-400"
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
                    indigo-gradient-rounded
                    rounded-full
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
                    space-y-4
                "
            >
                <li class="rounded-md w-full">
                    <Link
                        :href="route('user.index')"
                        class="
                            btn
                            indigo-gradient-rounded
                            justify-center
                            w-full
                            font-bold
                            text-white
                        "
                        ><span class="mr-3">Profile</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </Link>
                </li>
                <li v-if="$page.props.user" class="rounded-md w-full">
                    <jet-button
                        @click.stop="logout"
                        type="button"
                        classes="indigo-gradient-rounded justify-center w-full font-bold text-white"
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
                <li v-else class="rounded-md w-full">
                    <Link
                        @click.stop="closeMenu"
                        :href="route('login')"
                        class="
                            btn
                            indigo-gradient-rounded
                            justify-center
                            w-full
                            font-bold
                            text-white
                        "
                    >
                        <span class="mr-3">Login</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 fill-current"
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
                    </Link>
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
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: { NavLink, JetButton, Link },
    store: store,
    methods: {
        logout() {
            this.closeMenu();
            this.$inertia.post(route("logout"));
        },
        closeMenu() {
            document.getElementById("menu_icon_mobile").click();
        },
    },
});
</script>
