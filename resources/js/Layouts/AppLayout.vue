<template>
    <header-mobile />
    <div>
        <Head :title="title" />
        <offset>
            <navigation />
        </offset>

        <jet-banner />
        <div class="min-h-screen">
            <nav>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16">
                        <div class="flex w-full justify-between">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <jet-application-mark
                                        class="block h-9 w-auto"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div
                                class="
                                    hidden
                                    space-x-8
                                    sm:-my-px sm:ml-10 sm:flex
                                "
                            >
                                <Link
                                    :href="route('login')"
                                    :class="'text-indigo-400 inline-flex justify-center items-center'"
                                    ><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                            clip-rule="evenodd"
                                        /></svg
                                ></Link>
                            </div>

                            <div v-show="this.$page.props.user" class="h-full">
                                <span
                                    class="
                                        text-indigo-400
                                        font-semibold
                                        flex
                                        justify-center
                                        items-center
                                        h-full
                                    "
                                >
                                    {{ this.$page.props.user?.name }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <nav class="hidden sm:block pl-3 w-max">
                <div class="flex">
                    <ul class="flex">
                        <li
                            class="p-3"
                            :class="{
                                'border-b-2 border-indigo-700':
                                    active('dashboard'),
                            }"
                        >
                            <Link
                                :href="route('dashboard')"
                                :class="'text-indigo-500 font-semibold'"
                                >Dashboard</Link
                            >
                        </li>
                        <li
                            class="p-3"
                            :class="{
                                'border-b-2 border-indigo-700':
                                    active('products.index'),
                            }"
                        >
                            <Link
                                :href="route('products.index')"
                                :class="'text-indigo-500 font-semibold'"
                                >Products</Link
                            >
                        </li>
                        <li
                            class="p-3"
                            :class="{
                                'border-b-2 border-indigo-700':
                                    active('cart.index'),
                            }"
                        >
                            <Link
                                :href="route('cart.index')"
                                :class="'text-indigo-500 font-semibold'"
                                >Cart</Link
                            >
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2
                        class="
                            font-semibold
                            text-xl text-indigo-500
                            leading-tight
                        "
                    >
                        {{ title }}
                    </h2>
                </div>
            </header>

            <main class="pb-24 pt-5">
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import Navigation from "../Jetstream/Navigation.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import HeaderMobile from "../Jetstream/HeaderMobile.vue";
import Offset from "../Jetstream/Offset.vue";
import store from "../Plugins/VuexStore";
import Notification from "../components/Notification.vue";

export default defineComponent({
    props: {
        title: String,
    },
    store: store,
    components: {
        Head,
        JetApplicationMark,
        JetBanner,
        JetNavLink,
        Navigation,
        HeaderMobile,
        Offset,
        Link,
        Notification,
    },
    data() {
        return {
            showingNavigationDropdown: false,
        };
    },

    methods: {
        active(route) {
            let exp = new RegExp(this.$page.url + "$");
            return (
                exp.test(this.route(route)) ||
                ("/" === this.$page.url && route == "dashboard")
            );
        },
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id,
                },
                {
                    preserveState: false,
                }
            );
        },
    },
});
</script>
