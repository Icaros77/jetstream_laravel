<template>
    <page-link
        v-if="parseInt(link.label) && index < 2"
        :url="link.url"
        :page_number="link.label"
        :active="link.active"
    />
    <page-form v-else-if="index == 2 && last_page > 4" />
    <page-link
        v-else-if="parseInt(link.label)"
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
});
</script>
