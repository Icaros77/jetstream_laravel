<template>
    <header-mobile />
    <div>
        <Head :title="title" />
        <offset v-if="isLoggedIn">
            <navigation />
        </offset>
        <offset v-else>
            <login-signup />
        </offset>

        <jet-banner />

        <div class="min-h-screen">
            <nav
                class="
                    bg-gradient-to-br
                    from-gray-100
                    via-pink-100
                    to-indigo-100
                    border-b border-gray-100
                "
            >
                <!-- Primary Navigation Menu -->
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
                                <jet-nav-link
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    Dashboard
                                </jet-nav-link>
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
                                    >{{ this.$page.props.user?.name }}</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2
                        class="
                            font-semibold
                            text-xl text-gray-800
                            leading-tight
                        "
                    >
                        {{this.$page.component}}
                    </h2>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import Navigation from "../Jetstream/Navigation.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import HeaderMobile from "../Jetstream/HeaderMobile.vue";
import LoginSignup from "../Jetstream/LS.vue";
import Offset from "../Jetstream/Offset.vue";
import store from "../Plugins/VuexStore";
import { mapGetters } from "vuex";

export default defineComponent({
    setup() {
        // store.commit("checkSession");
    },
    props: {
        title: String,
    },
    store: store,
    components: {
        Head,
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        Navigation,
        HeaderMobile,
        Offset,
        LoginSignup,
        Link,
    },
    data() {
        return {
            showingNavigationDropdown: false,
        };
    },
    computed: {
        ...mapGetters(["isLoggedIn", "getUser"]),
    },

    methods: {
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

        logout() {
            this.$inertia.post(route("logout"));
        },
    },
});
</script>
