<template>
    <div v-show="check" class="fixed inset-0 w-full h-full bg-gray-500 opacity-50"></div>
    <div v-show="check"
        class="
            fixed
            inset-0
            flex
            justify-center
            items-center
            z-50
        "
    >
        <div
            class="
                w-4/5
                mx-auto
                flex
                justify-center
                items-center
                bg-gradient-to-br
                from-indigo-300
                to-indigo-500
                rounded-md
            "
        >
            <div class="flex flex-col p-5">
                <header class="p-3">
                    <h4>
                        <span class="inline-block text-white p-1"
                            >You have 2 active carts.</span
                        >
                        <span class="inline-block text-white p-1"
                            >Do you want to merge them?</span
                        >
                    </h4>
                </header>
                <div class="flex justify-around w-2/3 self-end p-2">
                    <button
                    ref="button_ok"
                        class="btn bg-indigo-600 text-white font-bold"
                    >
                        Ok
                    </button>
                    <button
                    ref="button_no"
                        class="btn bg-gray-300 text-white font-bold"
                    >
                        No
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: ["permission", "request"],
    computed: {
        check() {
            console.log(this.permissionGranted);
            console.log(this.askRequest);
            console.log(this.permissionGranted && this.askRequest);
            return this.permissionGranted ? false : this.askRequest;
        },
    }
});
</script>
