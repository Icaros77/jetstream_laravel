<template>
    <div class="h-full relative">
        <div
            :class="isSelected('Register')"
            class="
                p-5
                register
                bubble-animation
                flex
                absolute
                flex-col
                items-start
                justify-center
                h-full
                w-full
            "
        >
            <div class="p-4">
                <header>
                    <h1 class="text-indigo-500 italic font-bold text-2xl">
                        Sign up
                    </h1>
                </header>
            </div>
            <div class="w-full mt-4">
                <form @submit.prevent="login" class="p-2 flex flex-col w-full">
                    <label-name v-model="form.username" type="text"
                        >Username</label-name
                    >
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
                                border-none
                                shadow-lg
                            "
                        >
                            Login!
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div
            :class="isSelected('Login')"
            class="
                login
                p-5
                bubble-animation
                flex flex-col
                items-start
                justify-center
                absolute
                w-full
                h-full
            "
        >
            <div class="p-4">
                <header>
                    <h1 class="text-indigo-500 italic font-bold text-2xl">
                        Sign In
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
                                border-none
                                shadow-lg
                            "
                        >
                            Login!
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div  class="absolute bottom-0 left-0 z-50 w-full p-5">
            <button type="button" class="p-5 bg-white w-full rounded-full">{{ selected === 'Login' ? 'Sign up' : 'Sign in' }}</button>
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
            form: this.$inertia.form({
                username: "",
                email: "",
                password: "",
            }),
            selected: "Login",
        };
    },
    methods: {
        login(event) {
            this.form
                .transform((data) => ({ ...data }))
                .post(route("login"), {
                    onSuccess: (page) => {
                        this.$store.commit("assignUser", {
                            user: page.props.user,
                        });
                    },
                    onFinish: () => {
                        this.form.reset("password");
                    },
                });
        },
        isSelected(form) {
            return form === this.selected ? "z-30 show" : "z-40 hide";
        },
    },
});
</script>
