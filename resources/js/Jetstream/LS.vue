<template>
    <div class="h-full relative">
        <div
            :class="isSelected('SignUp')"
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
                <form
                    @submit.prevent="register"
                    class="p-2 flex flex-col w-full"
                >
                    <label-name v-model="formSignUp.name" type="text"
                        >Username</label-name
                    >
                    <label-name v-model="formSignUp.email" type="email"
                        >Email</label-name
                    >
                    <label-name v-model="formSignUp.password" type="password"
                        >Password</label-name
                    >
                    <label-name
                        v-model="formSignUp.password_confirmation"
                        type="password"
                        >Password Confirmation</label-name
                    >
                    <div class="p-2 w-1/2 self-end flex justify-end">
                        <button
                            type="submit"
                            class="
                                btn
                                bg-gradient-to-br
                                from-red-300
                                to-red-500
                                italics
                                border-none
                                shadow-lg
                            "
                        >
                            Sign up!
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div
            :class="isSelected('SignIn')"
            class="
                login
                p-5
                bubble-animation
                flex flex-col
                items-start
                justify-center
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
                    <label-name v-model="formSignIn.email" type="email"
                        >Email</label-name
                    >
                    <label-name v-model="formSignIn.password" type="password"
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
                            Sign in!
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full p-5">
            <button
                @click.stop="switchForm"
                type="button"
                :class="buttonGradient[selected]"
                class="
                    p-5
                    shadow-lg
                    w-full
                    rounded-full
                    transition-all
                    bg-gradient-to-br
                    text-white text-lg
                    uppercase
                "
            >
                {{ selected === "SignIn" ? "Sign up" : "Sign in" }}
            </button>
        </div>
        >
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
            formSignIn: this.$inertia.form({
                email: "",
                password: "",
            }),
            formSignUp: this.$inertia.form({
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            }),
            selected: "SignIn",
            buttonGradient: {
                SignUp: "from-red-300 to-red-500",
                SignIn: "from-indigo-300 to-indigo-500",
            },
        };
    },
    methods: {
        login(event) {
            axios.get("/sanctum/csrf-cookie").then(() => {
                this.formSignIn
                    .transform((data) => ({ ...data }))
                    .post(route("login"), {
                        onSuccess: async () => {
                            await this.$store.commit("offsetHeader/defaultMenu");
                        },
                        onFinish: () => {
                            this.formSignIn.reset("password");
                        },
                    });
            });
        },

        register(event) {
            axios.get("/sanctum/csrf-cookie").then(() => {
                this.formSignUp
                    .transform((data) => ({ ...data }))
                    .post(route("register"), {
                        onSuccess: async () => {
                            await this.$store.commit("offsetHeader/defaultMenu");
                        },
                        onFinish: (page) => {
                            this.formSignUp.reset();
                        },
                    });
            });
        },
        isSelected(form) {
            return form === this.selected ? "show" : "show hide";
        },
        switchForm() {
            this.selected = this.selected === "SignIn" ? "SignUp" : "SignIn";
        },
    },
});
</script>
