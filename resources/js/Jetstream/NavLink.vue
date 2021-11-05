<template>
    <Link :href="href" class="header-link">
        <slot />
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: {
            href: {
                type: String,
            },
            active: {
                default: false
            }
        },
    })
</script>
