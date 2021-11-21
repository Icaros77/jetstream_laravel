<template>
    <nav class="w-full flex justify-center p-3">
        <div class="w-full flex justify-center">
            <ul class="flex flex-wrap justify-around w-full p-3">
                <page-link
                    :condition="current_page <= last_page && current_page != 1"
                    :page_number="current_page - 1"
                    :path="path"
                />
                <page-link
                    :condition="
                        (current_page < last_page &&
                            current_page != 1 &&
                            last_page - 1 != current_page) ||
                        current_page == 1
                    "
                    :page_number="current_page"
                    :path="path"
                />
                <page-link
                    :condition="
                        current_page > last_page &&
                        !(current_page + 1 <= last_page)
                    "
                    :page_number="current_page + 1"
                    :path="path"
                />
                <page-form :path="path" />
                <page-link
                    :condition="
                        current_page != last_page &&
                        current_page + 1 < last_page
                    "
                    :page_number="last_page - 1"
                    :path="path"
                />
                <page-link
                    :condition="
                        current_page != last_page &&
                        current_page + 2 > last_page
                    "
                    :page_number="last_page"
                    :path="path"
                />
            </ul>
        </div>
    </nav>
</template>

<script>
import { defineComponent } from "vue";
import PageLink from "./NavigationPageLink.vue";
import PageForm from "./NavigationFormPage.vue";

export default defineComponent({
    components: {
        PageLink,
        PageForm,
    },
    props: {
        products: Object,
    },
    setup(props) {
        return { ...props.products };
    },
});
</script>
