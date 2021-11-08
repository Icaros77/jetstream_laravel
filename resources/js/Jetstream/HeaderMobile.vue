<template>
    <div
        class="
            w-screen
            h-20
            min-h-20
            bg-gray-100
            sm:hidden
            fixed
            bottom-0
            left-0
            right-0
            z-30
        "
    >
        <div class="flex w-full h-full items-center justify-between">
            <home-icon
                @select="button_selected"
                :buttonActive="activeButton === 'Home'"
            />
            <cart-icon
                @select="button_selected"
                :buttonActive="activeButton === 'Cart'"
            />
            <menu-icon
                v-if="isLoggedIn"
                @select="button_selected"
                :buttonActive="activeButton === 'Menu'"
            />
            <login-icon
                v-else
                @select="button_selected"
                :buttonActive="activeButton === 'Login'"
            />
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import Logo from "./ApplicationLogo.vue";
import HomeIcon from "./ButtonsIcons/HomeIcon.vue";
import CartIcon from "./ButtonsIcons/CartIcon.vue";
import MenuIcon from "./ButtonsIcons/MenuIcon.vue";
import LoginIcon from "./ButtonsIcons/LoginIcon.vue";
import store from "../Plugins/VuexStore";
import { mapGetters } from "vuex";

export default defineComponent({
    components: {
        Logo,
        HomeIcon,
        CartIcon,
        MenuIcon,
        LoginIcon,
    },
    store: store,
    data() {
        return {
            activeButton: "",
        };
    },
    computed: {
        ...mapGetters(["isLoggedIn"]),
    },
    methods: {
        button_selected(nameButton) {
            this.activeButton =
                this.activeButton === nameButton ? "" : nameButton;
        },
    },
});
</script>
