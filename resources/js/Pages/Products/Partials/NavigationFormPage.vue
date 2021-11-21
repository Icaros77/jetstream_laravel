<template>
    <li class="w-1/5 flex justify-center items-center">
        <div class="w-full">
            <form class="w-full" @submit.stop.prevent="fetchResults">
                <input
                    type="text"
                    class="
                        w-full
                        border-none
                        rounded-md
                        bg-gray-100
                        text-indigo-500
                        font-bold
                        text-center
                        shadow-lg
                    "
                    @input="searchPage"
                    v-model="form.page"
                    placeholder="..."
                />
            </form>
        </div>
    </li>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: ['path'],
    data() {
        return {
            form: this.$inertia.form({
                page: "",
            }),
        };
    },
    methods: {
        searchPage(event) {
            let value = event.target.value.match(/([^\d]+)/g);
            if (value || event.target.value.startsWith("0")) {
                this.form.page = "";
                return;
            }
            let page = parseInt(event.target.value);
            this.form.page =  page ? page.toString() : "";
        },
        fetchResults() {
            if(this.form.page > this.last_page) return;
            this.$inertia.get(route("products.index"), {page: this.form.page});
            // this.form.get(route("products.index", this.page), {});
        },
    },
});
</script>
