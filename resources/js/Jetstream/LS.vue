<template>
    <div class="p-5 h-full">
        <div
            class="
                flex flex-col
                items-start
                bg-gray-100
                rounded-lg
                justify-center
            "
        >
            <div class="p-4">
                <header>
                    <h1 class="text-indigo-500 italic font-bold text-2xl">
                        Login
                    </h1>
                </header>
            </div>
            <div class="w-full mt-4">
                <form @submit.prevent="login" class="p-2 flex flex-col w-full">
                    <label-name @update:value="update" type="email"
                        >Email</label-name
                    >
                    <label-name @update:value="update" type="password"
                        >Password</label-name
                    >
                    <div class="p-2 w-1/2 self-end flex justify-end">
                        <button
                            type="submit"
                            class="
                                btn
                                bg-gradient-to-br
                                from-indigo-300
                                to-indigo-500
                                italics
                            "
                        >
                            Login!
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import Button from "./Button.vue";
import LabelName from "./FormElements/LabelName.vue";
import store from "../Plugins/VuexStore";

export default defineComponent({
    components: {
        LabelName,
        Button,
    },
    store: store,
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        login(event) {
            const formData = new FormData();
            formData.append("email", this.email);
            formData.append("password", this.password);
            this.$store.dispatch("logUser", {
                formData,
            });
        },
        update({ value, type }) {
            this[type] = value;
        },
    },
});
</script>
