<template>
    <div class="w-full max-w-lg flex flex-col justify-center">
        <div
            class="
                p-3
                indigo-gradient-rounded
                shadow-lg
            "
        >
            <div class="w-4/5">
                <header>
                    <h3 v-if="products" class="text-white">Results for:</h3>
                    <h3 v-else class="text-white">No results found for:</h3>
                </header>
                <div class="pl-2">
                    <span class="italic font-bold text-white">{{ decodeFilter }}</span>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-white">Criteria:</span>
                <span class="italic font-bold text-white pl-2">{{ criteria }}</span>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: ["filter", "name", "category", "vendor", "products"],
    computed: {
        decodeFilter() {
            return this.filter.replace(/\++/, " ");
        },
        criteria() {
            let name = this.name == "true" ? "Product name, " : "";
            let category = this.category == "true" ? "Category, " : "";
            let vendor = this.vendor == "true" ? "Vendor, " : "";
            let criteria = name + category + vendor;
            criteria = criteria.replace(/, $/, "");
            criteria = criteria ? criteria : "No criteria specified";
            return criteria;
        },
    },
});
</script>
