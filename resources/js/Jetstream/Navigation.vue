<template>
    <nav class="h-full" style="min-width: 360px !important">
        <ul class="flex flex-wrap justify-around w-full p-8 px-12">
            <li class="width-48 max-w-xs/2 h-32 bg-gray-100 rounded-md">
                <nav-link :href="route('products.index')">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-18 w-18 fill-current text-red-400"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    <span class="mt-3 text-gray-400 font-bold">Products</span>
                </nav-link>
            </li>
            <li class="width-48 max-w-xs/2 h-32 bg-gray-100 rounded-md">
                <nav-link :href="route('products.index')">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-18 w-18 fill-current text-red-400"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    <span class="mt-3 text-gray-400 font-bold">Products</span>
                </nav-link>
            </li>
            <li class="width-48 max-w-xs/2 h-32 bg-gray-100 rounded-md">
                <nav-link :href="route('products.index')">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-18 w-18 fill-current text-red-400"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    <span class="mt-3 text-gray-400 font-bold">Products</span>
                </nav-link>
            </li>
        </ul>
    </nav>
</template>

<script>
import { defineComponent } from "vue";
import NavLink from "./NavLink.vue";

export default defineComponent({
    components: { NavLink },
});
</script>
