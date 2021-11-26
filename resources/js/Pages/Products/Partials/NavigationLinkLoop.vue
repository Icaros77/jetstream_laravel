<template>
    <page-link
        v-if="
            getPage == current_page + 1 && getPage != last_page ||
            getPage == current_page ||
            getPage == current_page - 1
        "
        :url="link.url"
        :page_number="link.label"
        :active="link.active"
    />
    <page-form v-else-if="getPage + 1 == last_page" />
    <page-link
        v-else-if="getPage == last_page"
        :url="link.url"
        :page_number="link.label"
        :active="link.active"
    />
</template>

<script>
import { defineComponent } from "vue";
import PageForm from "./NavigationFormPage.vue";
import PageLink from "./NavigationPageLink.vue";

export default defineComponent({
    components: { PageLink, PageForm },
    props: ["link", "index", "current_page", "last_page"],
    computed: {
        getPage() {
            console.log(this.index)
            return parseInt(this.link.label);
        },
    },
});
</script>
