<template>
    <div class="p-5 h-full">
        <div
            class="
                flex flex-col
                items-start
                bg-gray-100
                rounded-lg
                justify-center
            "
        >
            <div class="p-4">
                <header>
                    <h1 class="text-indigo-500 italic font-bold text-2xl">Login</h1>
                </header>
            </div>
            <div class="w-full mt-4">
                <form action="" class="p-2 flex flex-col w-full">
                    <div class="p-2 w-full relative">
                        <label-name type="email">Email</label-name>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import LabelName from "./FormElements/LabelName.vue";

export default defineComponent({
    components: {
        LabelName,
    },
});
</script>
