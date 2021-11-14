<template>
    <transition
        enter-active-class="ease-in duration-500"
        enter-from-class="h-0"
        enter-to-class="h-32"
        @after-enter="setHeightEnter"
    >
        <div
            v-show="this.$page.props.notification"
            id="notification"
            class="
                w-10/12
                mx-auto
                rounded-lg
                transition-all
                bg-gradient-to-br
                from-indigo-200
                to-indigo-400
                shadow-md
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
                    h-full
                    p-2
                "
            >
                <div
                    class="
                        flex
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
                            {{ $page.props.notification?.reason }}
                        </h2>
                    </header>
                </div>
                <div class="w-full p-2 flex justify-center items-center">
                    <span class="font-semibold text-white">{{
                        $page.props.notification?.message
                    }}</span>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    methods: {
        setHeightEnter(el) {
            el.classList.add("min-h-8");
            el.children[0].classList.add("opacity-100");
        }
    },
});
</script>
