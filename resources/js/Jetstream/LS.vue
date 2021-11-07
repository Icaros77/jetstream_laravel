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
                    <label-name v-model="form.email" type="email"
                        >Email</label-name
                    >
                    <label-name v-model="form.password" type="password"
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

export default defineComponent({
    components: {
        LabelName,
        Button,
    },
    data() {
        return {
            form: this.$inertia.form({
                email: "",
                password: "",
            }),
        };
    },
    methods: {
        login(event) {
            this.form
                .transform((data) => ({
                    ...data,
                    remember: this.form.remember ? "on" : "",
                }))
                .post(this.route("login"), {
                    onFinish: () => this.form.reset("password"),
                });
        },
    },
});
</script>
