<template>
    <div class="w-full fixed bottom-20 left-0">
        <div
            class="
                z-10
                absolute
                top-0
                left-0
                w-full
                flex flex-col
                transform
                transition-transform
                border-2
                border-b-none
                bg-gradient-to-br
                from-gray-50
                via-pink-50
                to-indigo-50
                border-indigo-300
            "
            :class="{
                '-translate-y-full': isFocused,
                'translate-y-full': !isFocused,
            }"
        >
            <header
                class="border-bottom-2 border-indigo-400 p-3 flex flex-between"
            >
                <h3
                    class="
                        p-0
                        m-0
                        flex-grow flex
                        items-center
                        text-indigo-500
                        font-bold
                    "
                >
                    Filter search per
                </h3>
                <button
                    @click.stop.prevent="loseFocus"
                    class="flex-shrink"
                    type="button"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8 fill-current text-indigo-500"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>
            </header>
            <div class="flex flex-wrap justify-around p-3 pb-6">
                <filter-check-box v-model="form.category" name="Category" />
                <filter-check-box v-model="form.vendor" name="Vendor" />
                <filter-check-box v-model="form.name" name="Name" />
            </div>
        </div>
        <div
            class="
                relative
                z-20
                bg-gradient-to-br
                from-gray-50
                via-pink-50
                to-indigo-50
                border-2
                border-indigo-300
            "
        >
            <form @submit.stop.prevent="filter">
                <filter-input
                    @filterFocus="filterFocus"
                    v-model="form.filter"
                    :processing="form.processing"
                />
            </form>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import FilterCheckBox from "./FilterCheckBox.vue";
import FilterInput from "./FilterInput.vue";

export default defineComponent({
    setup() {},
    components: {
        FilterCheckBox,
        FilterInput,
    },
    data() {
        return {
            hasFocus: false,
            form: this.$inertia.form({
                filter: "",
                name: false,
                vendor: false,
                category: false,
                processing: 0,
            }),
        };
    },

    computed: {
        isFocused() {
            return this.hasFocus;
        },
    },

    methods: {
        filterFocus() {
            this.hasFocus = true;
        },
        loseFocus() {
            this.hasFocus = false;
        },
        filter() {
            this.form
                .transform((data) => {
                    const check = {
                        ...data,
                    };
                    check.filter = check.filter.replace(/\s+/g, "+");
                    return check;
                })
                .get(route("products.index"));
        },
    },
});
</script>
