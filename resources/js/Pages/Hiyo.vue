<template>
    <div :style="styles">{{ test }}</div>
    <div :style="styles">
        {{ count }}
        <button @click="countUp"> {{count}} </button>
    </div>
    
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default defineComponent({
    components: {
        AppLayout,
    },
    props: {
        test: String,
    },
    data() {
        return {
            styles: {
                color: "red",
                padding: "25px",
                display: "flex",
                "flex-direction": "column",
                "justify-content": "center",
                "align-items": "center"
            },
            count: 0,
            styles2: {
                color: "blue",
                'font-size': '2rem',
                display: 'flex',
                'justify-content': 'flex-end',
            },
        };
    },
    computed: {
    },

    methods: {
        countUp(event) {
            this.count++;
        }
    }
});
</script>
