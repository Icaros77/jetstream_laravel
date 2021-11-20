<template>
    <transition
        enter-active-class="ease-in duration-150"
        enter-from-class="-translate-x-full"
        enter-to-class="translate-x-0"
    >
        <div
            @click="close"
            id="notification"
            class="
                min-h-8
                w-10/12
                mx-auto
                rounded-lg
                fixed
                bottom-1/4
                transition-transform
                bg-gradient-to-br
                from-indigo-200
                to-indigo-400
                shadow-md
                z-50
            "
            ref="notification"
        >
            <div
                class="
                    flex flex-col
                    justify-around
                    items-center
                    transition-all
                    opacity-0
                    w-full
                    min-h-full
                    p-2
                "
            >
                <div
                    v-show="show?.reason"
                    class="
                        flex flex-grow
                        justify-between
                        items-center
                        w-full
                        relative
                        opacity
                        p-2
                        pt-0
                    "
                >
                    <header>
                        <h2 class="text-white font-bold text-2xl">
                            {{ show?.reason }}
                        </h2>
                    </header>
                </div>
                <div
                    class="
                        w-full
                        p-2
                        flex-grow flex
                        justify-center
                        items-center
                    "
                >
                    <span class="font-semibold text-white">{{
                        show?.message
                    }}</span>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    data() {
        return {
            show: this.hasNotification
        }
    },
    computed: {
        hasNotification() {
            return this.$page.props.notifcation;
        },
    },
    methods: {
        setHeightEnter(el) {
            // el.classList.add("min-h-8");
            // el.children[0].classList.add("opacity-100");
        },
        close(event) {
            // setTimeout(() => {
            //     this.$page.props.notifcation = null;
            // }, 200);
            event.target.classList.add("-translate-x-full");
        },
    },
});
</script>
