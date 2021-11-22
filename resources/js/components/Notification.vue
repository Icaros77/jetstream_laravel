<template>
        <transition
            enter-active-class="ease-in duration-300"
            enter-class="-transition-x-full"
            enter-to-class="transition-0-full"
            leave-active-class="ease-in  duration-300"
            leave-class="transition-0-full"
            leave-to-class="-transition-x-full"
        >
            <div
                v-show="notification"
                class="
                    w-10/12
                    mx-auto
                    rounded-lg
                    fixed
                    bottom-32
                    left-0
                    transition
                    transition-transform
                    transform
                    bg-gradient-to-br
                    from-indigo-200
                    to-indigo-400
                    shadow-md
                    z-50
                "
                ref="notification"
            >
                <div
                    class="flex flex-col justify-around items-center w-full p-2"
                >
                    <div
                        v-show="notification?.reason"
                        class="
                            flex flex-grow
                            justify-between
                            items-center
                            w-full
                            p-2
                            pt-0
                        "
                    >
                        <header>
                            <h2 class="text-white font-bold text-2xl">
                                {{ notification?.reason }}
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
                        <span
                            class="
                                inline-flex
                                w-full
                                justify-center
                                items-center
                                font-semibold
                                text-white
                            "
                            >{{ notification?.message }}
                        </span>
                    </div>
                </div>
            </div>
        </transition>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: ["notification"],
});
</script>
