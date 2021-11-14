<template>
    <transition
        enter-active-class="ease-in duration-500"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
    >
        <div class="transition-all rounded-full bg-gradient-to-br from-red-400 to-red-600" v-if="showErrors()">
            <p class="text-sm font-bold text-white p-3 flex justift-center items-center">
                {{ showErrors() }}
            </p>
        </div>
    </transition>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: {
        errorBag: String,
        type: String,
    },
    methods: {
        showErrors() {
            let errors = this.$page.props.errors[this.errorBag];
            return errors?.[this.type] ? errors[this.type] : null; 
        },
    },
});
</script>
