<template>
    <div class="w-full sm:max-w-lg md:max-w-2xl fixed sm:static bottom-20 left-0">
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
                indigo-gradient-rounded
                rounded-none
                sm:hidden
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
                        text-white
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
                        class="h-8 w-8 fill-current text-white"
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
                indigo-gradient-rounded
                rounded-none
                sm:bg-none
                border-indigo-300
            "
        >
            <form
                @submit.stop.prevent="filter"
                class="
                    sm:border-b sm:rounded-lg sm:indigo-gradient-rounded
                "
            >
                <filter-input
                    @filterFocus="filterFocus"
                    v-model="form.filter"
                    :processing="form.processing"
                />
            </form>
            <div
                class="
                    hidden
                    mt-3
                    sm:flex
                    flex-col
                    indigo-gradient-rounded
                "
            >
                <header
                    @click="openFilters"
                    class="
                        border-bottom-2
                        w-max
                        border-indigo-400
                        p-3
                        flex flex-between
                        cursor-pointer
                    "
                >
                    <h3
                        class="
                            p-0
                            m-0
                            flex-grow flex
                            items-center
                            text-white
                            font-bold
                        "
                    >
                        Filter search per
                        <button
                            type="button"
                            class="p-2 transform transition-transform"
                            ref="icon_dropdown"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 fill-current text-white"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </h3>
                </header>
                <div
                    class="
                        flex flex-wrap
                        justify-around
                        p-3
                        pt-0
                        transition-all
                        h-0
                        hidden
                    "
                    ref="filters"
                >
                    <filter-check-box v-model="form.category" name="Category" />
                    <filter-check-box v-model="form.vendor" name="Vendor" />
                    <filter-check-box v-model="form.name" name="Name" />
                </div>
            </div>
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
                process: 0,
            }),
        };
    },

    computed: {
        isFocused() {
            return this.hasFocus;
        },
    },

    methods: {
        openFilters(event) {
            this.$refs.icon_dropdown.classList.toggle("-rotate-90");
            this.$refs.filters.classList.toggle("hidden");
            this.$refs.filters.classList.toggle("h-0");
        },
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
