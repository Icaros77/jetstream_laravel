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
            z-20
        "
    >
        <div class="flex w-full h-full items-center justify-between">
            <home-icon
                @select="button_selected"
                :buttonActive="activeButton === 'Home'"
            ></home-icon>
            <cart-icon
                @select="button_selected"
                :buttonActive="activeButton === 'Cart'"
            ></cart-icon>
            <menu-icon
                @select="button_selected"
                :buttonActive="activeButton === 'Menu'"
            ></menu-icon>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import Logo from "./ApplicationLogo.vue";
import HomeIcon from "./ButtonsIcons/HomeIcon.vue";
import CartIcon from "./ButtonsIcons/CartIcon.vue";
import MenuIcon from "./ButtonsIcons/MenuIcon.vue";

export default defineComponent({
    components: {
        Logo,
        HomeIcon,
        CartIcon,
        MenuIcon,
    },
    data() {
        return {
            activeButton: "",
        };
    },
    methods: {
        button_selected(nameButton) {
            this.activeButton =
                this.activeButton === nameButton ? "" : nameButton;
        },
    },
});
</script>
